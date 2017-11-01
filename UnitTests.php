<?php
use PHPUnit\Framework\TestCase;
require_once 'person.php';
require_once 'db.php';

class DBTests extends TestCase
{
    protected $db;
    protected $person;

    public function setUp()
    {
        $this->person = new Person(2,"Petra","Ivanovna",24, array());
        $this->db = new MockDB();
        $this->db->create($this->person);
    }

    public function testCreate()
    {
        $exp = $this->person;
        $res = $this->db->read();
        $this->assertEquals($exp, $res);
    }

    public function testUpdate()
    {
        $person = new Person(2,"Petr","Ivan",42, array());
        $this->db->update($person);
        $res = $this->db->read();

        $this->assertEquals($exp, $res);
    }

    public function testDelete()
    {

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