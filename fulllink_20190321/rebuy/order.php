<?php
abstract class Order
{
    public $OrderId;
    public $OrderDate;
    public $customerId;
    public $paymenttype;
    public $device;
    public $ordertype


    public function __construct($OrderId,$CustomerId,$OrderDate,$ordertype)
    {
        $this->CustomerId=$CustomerId;
        $this->OrderId=$OrderId;
        $this->OrderDate=$OrderDate;

        $this->ordertype=$ordertype;


    }

    public function getDevice($devicetype,$devicestorage,$devicecolour,$devicecondition)
    {
        $sql=query('SELECT * FROM inventory_devices WHERE `device_type_id`= $devicetype AND `dev$ice_storage_id`= $device_storage AND `device_colour`=$devicecolour AND `device_grade`=$devicecondition LIMIT 1');



    }

    public function makeOrder()
    {
        if(isset($this->ordertype)){
            $customerObj=new Customer($firstname,$lastname,$streetno,$addition,$city,$postcode,$country);

            switch():
                case $this->ordertype="purchase":
                    $PurchaseOrder=new PurchaseOrder();
                    Break;
                 case $this->ordertype="rebuy":
                  $RebuyOrder=new RebuyOrder();

                  endswitch;

        } else {
            echo "an error has occurred. ";
        }



    }
      public function CreateShipping()
      {
          $shipment=new Shipping($this->OrderId);
          $shipment->MakeLabel();
          $shipment->SendLabel($carrier);

      }



}

class Customer
{
    public $customerId=0;
    public $firstname;
    public $lastname;
    public $label;
    public $address;
    public $payment;



    public function __construct($firstname, $lastname,$streetno,$addition,$city,$postcode,$country)
    {
        $this->customerId=$this->customerId+1;
        $this->firstname=$firstname;
        $this->lastname=$lastname;
        $this->address=new Address($this->customerId,$streetno,$addition,$street,$city,$postcode,$country);

    }


    public function getPayment()
    {
        $this->payment=new Payment($this->customerId,$paymenttype,$Tnv,$Iban );
        return $this->payment;



    }






}


class RebuyOrder
{
    public $devicetypeestimated;
    public $storageTypeestimated;
    public $customerEst;
    public $ShippingLabel;
    public $customer_status;
    public $forza_status;
    public $connectiontypeestimated;
    public $quoteestimated;
    public $inspectiondate;
    public $devicetypeinspected;
    public $devicestorageinspected;
    public $device_connection_type_inspected:
    public $inspectionnotes;
    public $devicequote;



    public function getDevice()
    {
        $this->CustomerType=$CustomerType;
        $this->devicetype=$deviceType;
        $this->storageType=$storagetype;
        $this->customerEst=$customerEst;


    }





    public function CustomerEstimate($device_type_estimated,$storage_type_estimated,$Connection_type_estimated,$quote_estimated)
    {
        $this->devicetypeestimated=$device_type_estimated;
        $this->storageTypeestimated=$storage_type_estimated;
        $this->connectiontypeestimated=$Connection_type_estimated;
        $this->quoteestimated=$quote_estimated;


    }


    public function Inspection($inspectiondate,$device_type_inspected,$device_connection_type_inspected,$device_storage_type_inspected,$inspection_notes,$device_quote)
    {
        $this->inspectiondate;
        $this->devicetypeinspected;
        $this->devicestorageinspected;
        $this->device_connection_type_inspected:
        $this->inspectionnotes;
        $this->devicequote;


    }

    public function SetCustomerStatus($cust_status)
    {
        $this->customer_status=$cust_status;
        return $this;


    }

    public function GetCustomerStatus()
    {
        return $this->customer_status;


    }

    public function SetForzaStatus($forza_status)
    {
        $this->forza_status=$forza_status;
        return $this;

    }

    public function GetForzaStatus()
    {
        return $this->forza_status;

    }


    public function makepayment()
    {
        if($this->forza_status=='ACCEPTED' && parent::getpaymentmethod()==2)
        {
            $this->payment=array(
                'Iban'=>parent::getIban(),
                'Tnv'=>parent::getTnv(),
                'total'=>$this->devicequote


            );
            return $this->payment;

        }elseif($this->forza_status=='ACCEPTED' && parent::getpaymentmethod()==2)
        {
            parent::getforzacredit()=parent::getforzacredit+$this->devicequote;
            return parent::getforzacredit();

        }



    }

    public function EntertoInventory()
    {
        if($this->forza_status=='ACCEPTED')
        {
            $this->device= array(
                'devicetype'=>$this->devicetypeinspected,
                'deviceconnectiontype'=>$this->device_connection_type_inspected,
                'devicestoragetype'=>$this->device_storage_type_inspected


            );

            return $this->device;

        }

        self::inventory($this->device);



    }

    public function return()
    {
        if($this->forza_status=='DEVICE RETURNED')
        {
            echo parent::getLabel();

        }

    }

    public function recycle()
    {
        if($this->forza_status=='RECYCLE')
        {


        }

    }


    public function inventory()
    {



    }



}
