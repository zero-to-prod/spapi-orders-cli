<?php

namespace Zerotoprod\SpapiOrdersCli\GetOrderItems;

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
    name: GetOrderItemsCommand::signature,
    description: 'Get an Order.'
)]
class GetOrderItemsCommand extends Command
{
    public const signature = 'spapi-orders-cli:get-order';

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $Args = GetOrderItemsArguments::from($input->getArguments());
        $Options = GetOrderItemsOptions::from($input->getOptions());

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
            '/orders/v0/orders/'.$Args->order_id,
            ['buyerInfo', 'shippingAddress'],
            $Args->targetApplication,
            user_agent: $Options->user_agent,
        );

        if ($rdt_response['info']['http_code'] !== 200) {
            $output->writeln(json_encode($rdt_response, JSON_PRETTY_PRINT));

            return Command::SUCCESS;
        }

        $order_response = SpapiOrders::getOrderItems(
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
        $this->addArgument(GetOrderItemsArguments::refresh_token, InputArgument::REQUIRED, 'The LWA refresh token');
        $this->addArgument(GetOrderItemsArguments::client_id, InputArgument::REQUIRED, 'Get this value when you register your application');
        $this->addArgument(GetOrderItemsArguments::client_secret, InputArgument::REQUIRED, 'Get this value when you register your application');
        $this->addArgument(GetOrderItemsArguments::targetApplication, InputArgument::REQUIRED, 'The application ID for the target application to which access is being delegated.');
        $this->addArgument(GetOrderItemsArguments::order_id, InputArgument::REQUIRED, 'The Amazon Order ID');
        $this->addOption(GetOrderItemsOptions::user_agent, mode: InputOption::VALUE_OPTIONAL, description: 'User Agent');
        $this->addOption(GetOrderItemsOptions::response, mode: InputOption::VALUE_NONE, description: 'Returns the full response');
        $this->addOption(GetOrderItemsOptions::expiresIn, mode: InputOption::VALUE_NONE, description: 'The expiresIn value for the restrictedDataToken');
    }
}