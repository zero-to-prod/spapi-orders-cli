# Zerotoprod\SpapiOrdersCli

![](art/logo.png)

[![Repo](https://img.shields.io/badge/github-gray?logo=github)](https://github.com/zero-to-prod/spapi-orders-cli)
[![GitHub Actions Workflow Status](https://img.shields.io/github/actions/workflow/status/zero-to-prod/spapi-orders-cli/test.yml?label=test)](https://github.com/zero-to-prod/spapi-orders-cli/actions)
[![GitHub Actions Workflow Status](https://img.shields.io/github/actions/workflow/status/zero-to-prod/spapi-orders-cli/backwards_compatibility.yml?label=backwards_compatibility)](https://github.com/zero-to-prod/spapi-orders-cli/actions)
[![GitHub Actions Workflow Status](https://img.shields.io/github/actions/workflow/status/zero-to-prod/spapi-orders-cli/build_docker_image.yml?label=build_docker_image)](https://github.com/zero-to-prod/spapi-orders-cli/actions)
[![Packagist Downloads](https://img.shields.io/packagist/dt/zero-to-prod/spapi-orders-cli?color=blue)](https://packagist.org/packages/zero-to-prod/spapi-orders-cli/stats)
[![php](https://img.shields.io/packagist/php-v/zero-to-prod/spapi-orders-cli.svg?color=purple)](https://packagist.org/packages/zero-to-prod/spapi-orders-cli/stats)
[![Packagist Version](https://img.shields.io/packagist/v/zero-to-prod/spapi-orders-cli?color=f28d1a)](https://packagist.org/packages/zero-to-prod/spapi-orders-cli)
[![License](https://img.shields.io/packagist/l/zero-to-prod/spapi-orders-cli?color=pink)](https://github.com/zero-to-prod/spapi-orders-cli/blob/main/LICENSE.md)
[![wakatime](https://wakatime.com/badge/github/zero-to-prod/spapi-orders-cli.svg)](https://wakatime.com/badge/github/zero-to-prod/spapi-orders-cli)
[![Hits-of-Code](https://hitsofcode.com/github/zero-to-prod/spapi-orders-cli?branch=main)](https://hitsofcode.com/github/zero-to-prod/spapi-orders-cli/view?branch=main)

## Contents

- [Introduction](#introduction)
- [Requirements](#requirements)
- [Installation](#installation)
- [Documentation Publishing](#documentation-publishing)
    - [Automatic Documentation Publishing](#automatic-documentation-publishing)
- [Usage](#usage)
    - [Available Commands](#available-commands)
        - [`spapi-orders-cli:src`](#spapi-orders-clisrc)
        - [`spapi-orders-cli:get-order`](#spapi-orders-cliget-order)
        - [`spapi-orders-cli:get-order-items`](#spapi-orders-cliget-order-items)
        - [`spapi-orders-cli:get-order-buyer-info`](#spapi-orders-cliget-order-buyer-info)
        - [`spapi-orders-cli:get-order-address`](#spapi-orders-cliget-order-address)
- [Docker Image](#docker-image)
- [Local Development](./LOCAL_DEVELOPMENT.md)
- [Image Development](./IMAGE_DEVELOPMENT.md)
- [Contributing](#contributing)

## Introduction

A CLI for Amazon Selling Partner API (SPAPI) Orders API.

## Requirements

- PHP 8.1 or higher.

## Installation

Install `Zerotoprod\SpapiOrdersCli` via [Composer](https://getcomposer.org/):

```bash
composer require zero-to-prod/spapi-orders-cli
```

This will add the package to your project's dependencies and create an autoloader entry for it.

## Documentation Publishing

You can publish this README to your local documentation directory.

This can be useful for providing documentation for AI agents.

This can be done using the included script:

```bash
# Publish to default location (./docs/zero-to-prod/spapi-orders-cli)
vendor/bin/zero-to-prod-spapi-orders-cli

# Publish to custom directory
vendor/bin/zero-to-prod-spapi-orders-cli /path/to/your/docs
```

### Automatic Documentation Publishing

You can automatically publish documentation by adding the following to your `composer.json`:

```json
{
    "scripts": {
        "post-install-cmd": [
            "zero-to-prod-spapi-orders-cli"
        ],
        "post-update-cmd": [
            "zero-to-prod-spapi-orders-cli"
        ]
    }
}
```

## Usage

Run this command to see the available commands:

```shell
vendor/bin/spapi-orders-cli list
```

### Available Commands

#### `spapi-orders-cli:src`

Displays the project's GitHub repository URL.

**Usage:**
```shell
vendor/bin/spapi-orders-cli spapi-orders-cli:src
```

**Arguments:** None

**Example:**
```shell
vendor/bin/spapi-orders-cli spapi-orders-cli:src
```

**Sample Output:**
```
https://github.com/zero-to-prod/spapi-orders-cli
```

#### `spapi-orders-cli:get-order`

Retrieves order details from Amazon's Selling Partner API for a specific order ID.

**Usage:**
```shell
vendor/bin/spapi-orders-cli spapi-orders-cli:get-order <refresh_token> <client_id> <client_secret> <target_application> <order_id> [options]
```

**Required Arguments:**
- `refresh_token` - The LWA refresh token
- `client_id` - Get this value when you register your application
- `client_secret` - Get this value when you register your application
- `target_application` - The application ID for the target application to which access is being delegated
- `order_id` - The Amazon Order ID

**Options:**
- `--user_agent` - User Agent (optional)
- `--response` - Returns the full response (flag)
- `--expiresIn` - The expiresIn value for the restrictedDataToken (flag)

**Example:**
```shell
vendor/bin/spapi-orders-cli spapi-orders-cli:get-order "refresh_token_here" "client_id_here" "client_secret_here" "app_id_here" "123-4567890-1234567"
```

**Sample Output:**
```json
{
    "AmazonOrderId": "123-4567890-1234567",
    "PurchaseDate": "2023-12-01T14:30:00Z",
    "LastUpdateDate": "2023-12-02T10:15:00Z",
    "OrderStatus": "Shipped",
    "FulfillmentChannel": "MFN",
    "SalesChannel": "Amazon.com",
    "OrderChannel": "Online",
    "ShipServiceLevel": "Std US D2D Dom",
    "NumberOfItemsShipped": 1,
    "NumberOfItemsUnshipped": 0,
    "PaymentExecutionDetail": [],
    "PaymentMethod": "Other",
    "MarketplaceId": "ATVPDKIKX0DER",
    "BuyerEmail": "buyer@example.com",
    "BuyerName": "John Doe",
    "BuyerCounty": "King",
    "BuyerTaxInfo": {
        "CompanyLegalName": "Example Company",
        "TaxingRegion": "WA",
        "TaxClassifications": []
    },
    "ShipmentServiceLevelCategory": "Standard",
    "ShippedByAmazonTFM": false,
    "TFMShipmentStatus": "PendingPickUp",
    "OrderType": "StandardOrder",
    "EarliestShipDate": "2023-12-01T00:00:00Z",
    "LatestShipDate": "2023-12-03T23:59:59Z",
    "EarliestDeliveryDate": "2023-12-05T00:00:00Z",
    "LatestDeliveryDate": "2023-12-08T23:59:59Z",
    "IsBusinessOrder": false,
    "IsPrime": true,
    "IsPremiumOrder": false,
    "IsGlobalExpressEnabled": false,
    "ReplacedOrderId": null,
    "IsReplacementOrder": false,
    "PromiseResponseDueDate": "2023-12-01T16:30:00Z",
    "IsEstimatedShipDateSet": false
}
```

#### `spapi-orders-cli:get-order-items`

Retrieves the items for a specific order from Amazon's Selling Partner API.

**Usage:**
```shell
vendor/bin/spapi-orders-cli spapi-orders-cli:get-order-items <refresh_token> <client_id> <client_secret> <target_application> <order_id> [options]
```

**Required Arguments:**
- `refresh_token` - The LWA refresh token
- `client_id` - Get this value when you register your application
- `client_secret` - Get this value when you register your application
- `target_application` - The application ID for the target application to which access is being delegated
- `order_id` - The Amazon Order ID

**Options:**
- `--user_agent` - User Agent (optional)
- `--response` - Returns the full response (flag)
- `--expiresIn` - The expiresIn value for the restrictedDataToken (flag)

**Example:**
```shell
vendor/bin/spapi-orders-cli spapi-orders-cli:get-order-items "refresh_token_here" "client_id_here" "client_secret_here" "app_id_here" "123-4567890-1234567"
```

**Sample Output:**
```json
{
    "OrderItems": [
        {
            "ASIN": "B08N5WRWNW",
            "SellerSKU": "SKU-12345",
            "OrderItemId": "12345678901234",
            "Title": "Example Product Title",
            "QuantityOrdered": 1,
            "QuantityShipped": 1,
            "ProductInfo": {
                "NumberOfItems": 1
            },
            "PointsGranted": {
                "PointsNumber": 0
            },
            "ItemPrice": {
                "CurrencyCode": "USD",
                "Amount": "29.99"
            },
            "ShippingPrice": {
                "CurrencyCode": "USD",
                "Amount": "5.99"
            },
            "ItemTax": {
                "CurrencyCode": "USD",
                "Amount": "2.70"
            },
            "ShippingTax": {
                "CurrencyCode": "USD",
                "Amount": "0.54"
            },
            "ShippingDiscount": {
                "CurrencyCode": "USD",
                "Amount": "0.00"
            },
            "PromotionDiscount": {
                "CurrencyCode": "USD",
                "Amount": "0.00"
            },
            "ConditionId": "New",
            "ConditionSubtypeId": "New",
            "ConditionNote": "",
            "PriceDesignation": "BusinessPrice",
            "TaxCollection": {
                "Model": "MarketplaceFacilitator",
                "ResponsibleParty": "Amazon Services, Inc."
            },
            "SerialNumberRequired": false,
            "IsTransparency": false,
            "IossNumber": "",
            "StoreChainStoreId": "",
            "DeemedResellerCategory": "IOSS",
            "BuyerInfo": {
                "BuyerCustomizedInfo": {
                    "CustomizedURL": ""
                },
                "GiftWrapPrice": {
                    "CurrencyCode": "USD",
                    "Amount": "0.00"
                },
                "GiftWrapTax": {
                    "CurrencyCode": "USD",
                    "Amount": "0.00"
                },
                "GiftMessageText": "",
                "GiftWrapLevel": "None"
            }
        }
    ]
}
```

#### `spapi-orders-cli:get-order-buyer-info`

Retrieves buyer information for a specific order from Amazon's Selling Partner API.

**Usage:**
```shell
vendor/bin/spapi-orders-cli spapi-orders-cli:get-order-buyer-info <refresh_token> <client_id> <client_secret> <target_application> <order_id> [options]
```

**Required Arguments:**
- `refresh_token` - The LWA refresh token
- `client_id` - Get this value when you register your application
- `client_secret` - Get this value when you register your application
- `target_application` - The application ID for the target application to which access is being delegated
- `order_id` - The Amazon Order ID

**Options:**
- `--user_agent` - User Agent (optional)
- `--response` - Returns the full response (flag)
- `--expiresIn` - The expiresIn value for the restrictedDataToken (flag)

**Example:**
```shell
vendor/bin/spapi-orders-cli spapi-orders-cli:get-order-buyer-info "refresh_token_here" "client_id_here" "client_secret_here" "app_id_here" "123-4567890-1234567"
```

**Sample Output:**
```json
{
    "AmazonOrderId": "123-4567890-1234567",
    "BuyerEmail": "buyer@example.com",
    "BuyerName": "John Doe",
    "BuyerCounty": "King",
    "BuyerTaxInfo": {
        "CompanyLegalName": "Example Company Inc.",
        "TaxingRegion": "WA",
        "TaxClassifications": [
            {
                "Name": "VAT",
                "Value": "US123456789"
            }
        ]
    },
    "PurchaseOrderNumber": "PO-2023-12345"
}
```

#### `spapi-orders-cli:get-order-address`

Returns the shipping address for the specified order from Amazon's Selling Partner API.

**Usage:**
```shell
vendor/bin/spapi-orders-cli spapi-orders-cli:get-order-address <refresh_token> <client_id> <client_secret> <target_application> <order_id> [options]
```

**Required Arguments:**
- `refresh_token` - The LWA refresh token
- `client_id` - Get this value when you register your application
- `client_secret` - Get this value when you register your application
- `target_application` - The application ID for the target application to which access is being delegated
- `order_id` - The Amazon Order ID

**Options:**
- `--user_agent` - User Agent (optional)
- `--response` - Returns the full response (flag)
- `--expiresIn` - The expiresIn value for the restrictedDataToken (flag)

**Example:**
```shell
vendor/bin/spapi-orders-cli spapi-orders-cli:get-order-address "refresh_token_here" "client_id_here" "client_secret_here" "app_id_here" "123-4567890-1234567"
```

**Sample Output:**
```json
{
    "AmazonOrderId": "123-4567890-1234567",
    "ShippingAddress": {
        "Name": "John Doe",
        "AddressLine1": "123 Main Street",
        "AddressLine2": "Apt 456",
        "AddressLine3": "",
        "City": "Seattle",
        "County": "King",
        "District": "",
        "StateOrRegion": "WA",
        "Municipality": "",
        "PostalCode": "98101",
        "CountryCode": "US",
        "Phone": "555-123-4567",
        "AddressType": "Residential"
    }
}
```

**Note:** All SPAPI commands return JSON-formatted responses. Make sure to have valid Amazon SP-API credentials and proper permissions to access order data.

## Docker Image

You can also run the cli using the [docker image](https://hub.docker.com/repository/docker/davidsmith3/spapi-orders-cli/general):

```shell
docker run --rm davidsmith3/spapi-orders-cli
```

## Contributing

Contributions, issues, and feature requests are welcome!
Feel free to check the [issues](https://github.com/zero-to-prod/spapi-orders-cli/issues) page if you want to contribute.

1. Fork the repository.
2. Create a new branch (`git checkout -b feature-branch`).
3. Commit changes (`git commit -m 'Add some feature'`).
4. Push to the branch (`git push origin feature-branch`).
5. Create a new Pull Request.
