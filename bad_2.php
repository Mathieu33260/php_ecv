<?php

class Car {

    /** @var integer $id */
    private $id;

    /** @var boolean $broken */
    private $broken;

    /** @var string $brand */
    private $brand;

    /** @var int $nbCar */
    private static $nbCar = 0;

    /** @var int $nbWheel */
    private $nbWheel = 0;

    /** @var ArrayObject|Wheel[] $wheels */
    private $wheels;

    public function __construct($broken, $brand) {
        self::$nbCar++;
        $this->id = self::$nbCar;
        $this->broken = $broken;
        $this->brand = $brand;
        for($i=0;$i<4;$i++) {
            $this->nbWheel++;
            $this->wheels[$i] = new Wheel($this->nbWheel, false);
        }
    }

    /**
     * @return int
     */
    public static function getNbCar()
    {
        return self::$nbCar;
    }

    /**
     * @param int $nbCar
     */
    public static function setNbCar($nbCar)
    {
        self::$nbCar = $nbCar;
    }

    /**
     * @return int
     */
    public function getNbWheel()
    {
        return $this->nbWheel;
    }

    /**
     * @param int $nbWheel
     */
    public function setNbWheel($nbWheel)
    {
        $this->nbWheel = $nbWheel;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return bool
     */
    public function isBroken()
    {
        return $this->broken;
    }

    /**
     * @param bool $broken
     */
    public function setBroken($broken)
    {
        $this->broken = $broken;
    }

    /**
     * @return string
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param string $brand
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;
    }

    /**
     * @return ArrayObject|Wheel[]
     */
    public function getWheels()
    {
        return $this->wheels;
    }

    /**
     * @param ArrayObject|Wheel[] $wheels
     */
    public function setWheels($wheels)
    {
        $this->wheels = $wheels;
    }


}

class Wheel {

    /** @var integer $id */
    private $id;

    /** @var boolean $flat */
    private $flat;

    public function __construct($id, $flat) {
        $this->id = $id;
        $this->flat = $flat;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return bool
     */
    public function isFlat()
    {
        return $this->flat;
    }

    /**
     * @param bool $flat
     */
    public function setFlat($flat)
    {
        $this->flat = $flat;
    }
}

class Parking {

    /** @var integer $id */
    private $id;

    /** @var ArrayObject|Car[] $cars */
    private $cars;

    /** @var int $nbParking */
    private static $nbParking = 0;

    public function __construct() {
        self::$nbParking++;
        $this->id = self::$nbParking;
    }

    /**
     * @param  Car
     */
    public function addCar(Car $car) {
        $this->cars[] = $car;
    }

    /**
     * @return int
     */
    public static function getNbParking()
    {
        return self::$nbParking;
    }

    /**
     * @param int $nbParking
     */
    public static function setNbParking($nbParking)
    {
        self::$nbParking = $nbParking;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return ArrayObject|Car[]
     */
    public function getCars()
    {
        return $this->cars;
    }

    /**
     * @param ArrayObject|Car[] $cars
     */
    public function setCars($cars)
    {
        $this->cars = $cars;
    }
}

//build the first car
$porsche = new Car(true,"porsche");

//Now i flat my tire
$porsche->getWheels()[$porsche->getNbWheel()-1]->setFlat(true);

//Now fix car
$porsche->setBroken(false);

// Now fix flat week 
foreach($porsche->getWheels() as $wheel) {
    $wheel->setFlat(false);
}

// Car broke again 
$porsche->setBroken(true);

// So we have to fix again ....
$porsche->setBroken(false);

//build a second car 
$fiat = new Car(true,"fiat");

//Park cars in my parking
$parking = new Parking();
$parking->addCar($porsche);
$parking->addCar($fiat);

//take my car with brand
$myPorsche = null;
foreach($parking->getCars() as $car){
	if($car->getBrand() == 'porsche'){
		$myPorsche = clone $car;
	}
}

var_dump($myPorsche);
var_dump($fiat);
var_dump($parking);
