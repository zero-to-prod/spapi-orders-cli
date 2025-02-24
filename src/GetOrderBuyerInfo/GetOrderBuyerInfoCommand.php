<?php

namespace Zerotoprod\SpapiOrdersCli\GetOrderBuyerInfo;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Zerotoprod\SpapiLwa\SpapiLwa;
use Zerotoprod\SpapiOrders\SpapiOrders;
use Zerotoprod\SpapiRdt\SpapiRdt;
use Zerotoprod\SpapiTokens\SpapiTokens;

/**
 * @link https://github.com/zero-to-prod/spapi-orders-cli
 */
#[AsCommand(
    name: GetOrderBuyerInfoCommand::signature,
    description: 'Get an Order Buyer Info.'
)]
class GetOrderBuyerInfoCommand extends Command
{
    /**
     * @link https://github.com/zero-to-prod/spapi-orders-cli
     */
    public const signature = 'spapi-orders-cli:get-order-buyer-info';

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $Args = GetOrderBuyerInfoArguments::from($input->getArguments());
        $Options = GetOrderBuyerInfoOptions::from($input->getOptions());

        $response = SpapiLwa::from(
            $Args->client_id,
            $Args->client_secret,
            'https://api.amazon.com/auth/o2/token',
            $Options->user_agent
        )->refreshToken($Args->refresh_token);

        if ($response['info']['http_code'] !== 200) {
            $output->writeln(json_encode($response, JSON_PRETTY_PRINT));

            return Command::SUCCESS;
        }

        $rdt_response = SpapiRdt::from(
            SpapiTokens::from(
                $response['response']['access_token'],
                $Args->targetApplication,
                user_agent: $Options->user_agent,
            )
        )
            ->orders()
            ->getOrderBuyerInfo($Args->order_id);

        if ($rdt_response['info']['http_code'] !== 200) {
            $output->writeln(json_encode($rdt_response, JSON_PRETTY_PRINT));

            return Command::SUCCESS;
        }

        $output->writeln(
            json_encode(
                SpapiOrders::from(
                    $rdt_response['response']['restrictedDataToken'],
                    'https://sellingpartnerapi-na.amazon.com',
                    $Options->user_agent
                )->getOrderBuyerInfo($Args->order_id),
                JSON_PRETTY_PRINT
            )
        );

        return Command::SUCCESS;
    }

    /**
     * @link https://github.com/zero-to-prod/spapi-orders-cli
     */
    public function configure(): void
    {
        $this->addArgument(GetOrderBuyerInfoArguments::refresh_token, InputArgument::REQUIRED, 'The LWA refresh token');
        $this->addArgument(GetOrderBuyerInfoArguments::client_id, InputArgument::REQUIRED, 'Get this value when you register your application');
        $this->addArgument(GetOrderBuyerInfoArguments::client_secret, InputArgument::REQUIRED, 'Get this value when you register your application');
        $this->addArgument(GetOrderBuyerInfoArguments::targetApplication, InputArgument::REQUIRED, 'The application ID for the target application to which access is being delegated.');
        $this->addArgument(GetOrderBuyerInfoArguments::order_id, InputArgument::REQUIRED, 'The Amazon Order ID');
        $this->addOption(GetOrderBuyerInfoOptions::user_agent, mode: InputOption::VALUE_OPTIONAL, description: 'User Agent');
        $this->addOption(GetOrderBuyerInfoOptions::response, mode: InputOption::VALUE_NONE, description: 'Returns the full response');
        $this->addOption(GetOrderBuyerInfoOptions::expiresIn, mode: InputOption::VALUE_NONE, description: 'The expiresIn value for the restrictedDataToken');
    }
}