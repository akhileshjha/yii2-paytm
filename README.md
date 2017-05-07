# yii2-paytm
Paytm Integration in YII2

## IHow to install 
1.create a components folder under the common folder of root directory if it does not exist.  
  Copy the yii2-paytm/components/Paytm Class to thta folder  

2.Now go to common/models folder and copy the Crypto class to that folder


3.I have created two action Payment And paymentSuccess inside  the frontend/SiteController  
 

4. When user will click on payment button on the payment page then they will be redirected to paytm website where they can make payment

  You also have to copy yii2-paytm/views/payment.php file into your views.



            $params = [
                'ORDER_ID' =>  '**********',
                'CUST_ID' =>  '**********',
                'TXN_AMOUNT' =>  '**********',
                'EMAIL' => '**********',
                'MOBILE_NO' => '***********'
            ];


            \common\components\Paytm::configPaytm($params, 'test');
 ```
  
  test = staging mode
  live = production mode


5. actionPaymentSuccess will be use to get transaction details from paytm
  
  Your are done!!.  


## Note
I have done becuase there is no tutorial available for paytm integration in yii2
I Hope that it will help someone and save time as well

Thanks
