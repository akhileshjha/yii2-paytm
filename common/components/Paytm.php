<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Paytm
 *
 * @author Akhilesh Jha <akhileshjha.48@gmail.com>
 */

namespace common\components;

use Yii;
use yii\base\Component;
use common\models\Crypto;

class Paytm extends Component

{

    /**
     * @author Akhilesh Jha<akhileshjha.48@gmail.com>
     * @param type $params  data required for checkout
     * @param type $env  environment will be test or production
     */
    
    static function configPaytm($params, $env)
    {

     

        //for live
        if ($env == 'live') {
           $paytm_domain =  'https://secure.paytm.in/oltp-web/processTransaction';
            $params['MID'] =  '****************'; // Shared by Paytm
            $params['INDUSTRY_TYPE_ID'] =  '****************'; // Shared by Paytm
            $params['CHANNEL_ID'] =  '****************'; // Shared by Paytm
            $params['WEBSITE'] =  '****************'; // Shared by Paytm
            $params['Merchant_Key'] =  '****************'; // Shared by Paytm
           
        }

        //for test server if any
        if ($env == 'test') {
            $paytm_domain =  "pguat.paytm.com";
            $params['MID'] =  '****************'; // Shared by Paytm
            $params['INDUSTRY_TYPE_ID'] =  '****************'; // Shared by Paytm
            $params['CHANNEL_ID'] =  '****************'; // Shared by Paytm
            $params['WEBSITE'] =  '****************'; // Shared by Paytm
            $params['Merchant_Key'] =  '****************'; // Shared by Paytm
        }
        $paytm_refund_url =  'https://'.$paytm_domain.'/oltp/HANDLER_INTERNAL/REFUND';
        $paytm_status_query_url =  'https://'.$paytm_domain.'/oltp/HANDLER_INTERNAL/TXNSTATUS';
        $paytm_status_query_new_url =  'https://'.$paytm_domain.'/oltp/HANDLER_INTERNAL/getTxnStatus';
        $paytm_txn_url =  'https://'.$paytm_domain.'/oltp/HANDLER_INTERNAL/processTransaction';
       

        $cryptoModel = new Crypto;
       $checkSum = $cryptoModel->getChecksumFromArray($params,$params['Merchant_Key']);

        //$encrypted_data = encrypt($merchant_data, $working_key);
      
        echo '<form name="f1" id="2checkout" action="https://secure.paytm.in/oltp-web/processTransaction" method="post">';
          foreach($params as $name => $value) {
                echo '<input type="hidden" name="' . $name .'" value="' . $value . '">';
            }
        echo ' <input type="hidden" name="CHECKSUMHASH" value="' .$checkSum . '">';
        echo '<script type="text/javascript">document.getElementById("2checkout").submit();</script>';
        echo '<input type="submit" value="Click here if you are not redirected automatically" /></form>';
        echo '</form>';
        }




       }
