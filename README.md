# asgardcms-icommercelocaldelivery

## Seeder

    run php artisan module:seed Icommercelocaldelivery

## Configurations

    - feetype (percentage cart or fixed amount per product)
    - deliveryfee (percentage or amount)
    

## API

     ### Parameters
        * @param Requests request
        * @param Requests array "products" - items (object) 
        * @param Requests array "products" - total (float)
        * @param Requests array "options" - countryCode (string)
        
     ### Example
        https://mydomain/api/icommercelocaldelivery
