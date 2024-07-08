<?php
/**
 * Created by PhpStorm.
 * User: SimonaThrussell
 * Date: 18/09/2018
 * Time: 12:25
 */

class rebuyOffer
{
   public $orderid;
   public $quote;
   public $paymentdata;


    public function __construct($orderid,$quote)
{
    $this->orderid=$orderid;
    $this->quote=$quote;


}

    public function getPaymentData()
{
      $query=mysqli_query(" SELECT `cust_iban`,`cust_iban_name` FROM forzaerp_orderas r join rrebuyplus_customer_paymentas c on r.order_id=c.order_id WHERE r.order_id=$this->orderid",Connection()->connect());
      $this->paymentdata=array(
                'order id'=>$this->orderid,
                'customer Iban'=>$query['cust_iban'],
                'customer Tnv'=>$query['cust_iban_name']
      );

        return $this->paymentdata;

}


    public function setAction()
    {



    }



























}