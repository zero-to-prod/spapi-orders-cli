<?php

namespace Zerotoprod\SpapiOrdersCli\GetOrderAddress;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Zerotoprod\SpapiLwa\SpapiLwa;
use Zerotoprod\SpapiOrders\SpapiOrders;
use Zerotoprod\SpapiTokens\SpapiTokens;

#[AsCommand(
    name: GetOrderAddressCommand::signature,
    description: 'Returns the shipping address for the order that you specify.'
)]
class GetOrderAddressCommand extends Command
{
    public const signature = 'spapi-orders-cli:get-order-address';

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $Args = GetOrderAddressArguments::from($input->getArguments());
        $Options = GetOrderAddressOptions::from($input->getOptions());

        $response = SpapiLwa::refreshToken(
            'https://api.amazon.com/auth/o2/token',
            $Args->refresh_token,
            $Args->client_id,
            $Args->client_secret,
            $Options->user_agent
        );

        if ($response['info']['http_code'] !== 200) {
            $output->writeln(json_encode($response, JSON_PRETTY_PRINT));

            return Command::SUCCESS;
        }

        $rdt_response = SpapiTokens::createRestrictedDataToken(
            $response['response']['access_token'],
            "/orders/v0/orders/$Args->order_id/address",
            [],
            $Args->targetApplication,
            user_agent: $Options->user_agent,
        );

        if ($rdt_response['info']['http_code'] !== 200) {
            $output->writeln(json_encode($rdt_response, JSON_PRETTY_PRINT));

            return Command::SUCCESS;
        }

        $order_response = SpapiOrders::getOrderAddress(
            'https://sellingpartnerapi-na.amazon.com',
            $rdt_response['response']['restrictedDataToken'],
            $Args->order_id,
            $Options->user_agent
        );

        $output->writeln(json_encode($order_response, JSON_PRETTY_PRINT));

        return Command::SUCCESS;
    }

    public function configure(): void
    {
        $this->addArgument(GetOrderAddressArguments::refresh_token, InputArgument::REQUIRED, 'The LWA refresh token');
        $this->addArgument(GetOrderAddressArguments::client_id, InputArgument::REQUIRED, 'Get this value when you register your application');
        $this->addArgument(GetOrderAddressArguments::client_secret, InputArgument::REQUIRED, 'Get this value when you register your application');
        $this->addArgument(GetOrderAddressArguments::targetApplication, InputArgument::REQUIRED, 'The application ID for the target application to which access is being delegated.');
        $this->addArgument(GetOrderAddressArguments::order_id, InputArgument::REQUIRED, 'The Amazon Order ID');
        $this->addOption(GetOrderAddressOptions::user_agent, mode: InputOption::VALUE_OPTIONAL, description: 'User Agent');
        $this->addOption(GetOrderAddressOptions::response, mode: InputOption::VALUE_NONE, description: 'Returns the full response');
        $this->addOption(GetOrderAddressOptions::expiresIn, mode: InputOption::VALUE_NONE, description: 'The expiresIn value for the restrictedDataToken');
    }
}