<?php
use PHPUnit\Framework\TestCase;
require_once 'person.php';
require_once 'db.php';

class DBTests extends TestCase
{
    protected $db;
    protected $person;
    protected $persons;

    public function setUp()
    {
        $this->persons = array();
        $this->person = new Person(2,"Petra","Ivanovna",24, array());
        $this->db = new MockDB();
        $this->db->create($this->person);
        array_push($this->persons, $this->person);
    }

    public function testCreate()
    {
        $exp = $this->persons;
        $res = $this->db->read();
        $this->assertEquals($exp, $res);
    }

    public function testUpdate()
    {
        $person = new Person(2,"Petr","Ivan",42, array());
        $this->db->update($person);
        $res = $this->db->read();
        $exp = $this->persons;
        $this->assertEquals($exp, $res);
    }

    public function testDelete()
    {
        $person = new Person(2,"Petra","Ivanovna",24, array());
        $this->db->del($person);
        $res = $this->db->read();
        $exp = $this->persons;
        $this->assertEquals($exp, $res);
    }

    public function testReadJSON()
    {

    }

    public function testReadXML()
    {

    }

    public function testReadXSLT()
    {

    }

    public function testReadHTML()
    {

    }
}