<?php
session_start();
$fileName = "employees.xml";
$fileContent = file_get_contents($fileName);
$doc = new DOMDocument();
$doc->preserveWhiteSpace = false;
$doc->loadXML($fileContent);

$elementsLength = $doc->getElementsByTagName("employee")->length;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if(isset($_POST['add'])){
		$employees = simplexml_load_file('employees.xml');
		$employee = $employees->addChild('employee');
        $employee->addChild('id', uniqid());
		$employee->addChild('name', $_POST['name']);
		$employee->addChild('email', $_POST['email']);
		$employee->addChild('phone', $_POST['phone']);
		$employee->addChild('address', $_POST['address']);
		$dom = new DomDocument();
		$dom->preserveWhiteSpace = false;
		$dom->formatOutput = true;
		$dom->loadXML($employees->asXML());
		$dom->save('employees.xml');
		$_SESSION['message'] = 'Member added successfully';
		header('location: index.php');
	}
    }
    $index = $_SESSION["myIndex"];
    if (@$_POST["action"] === "next" && $index < $elementsLength-1) {
        $_SESSION["myIndex"] += 1;
    }

    if (@$_POST["action"] === "prev" && $index > 0) {
        $_SESSION["myIndex"] -= 1;
    }

    if (@$_POST["action"] === "update") {
        
        $xml = simplexml_load_file('employees.xml');

        $id = $_POST['id'];
        $employee = $xml->xpath("//employee[id='$id']")[0];
        $employee->name = $_POST['name'];
        $employee->phone = $_POST['phone'];
        $employee->address = $_POST['address'];
        $employee->email = $_POST['email'];

        $xml->asXML('employees.xml');

    }
    if (@$_POST["action"] === "delete") {
        
        $xml = simplexml_load_file('employees.xml');

        $id = $_POST['id'];
        $employee = $xml->xpath("//employee[id='$id']")[0];

        unset($employee[0]);

        $xml->asXML('employees.xml');
    }

    

$index = @$_SESSION["myIndex"];
$employees = $doc->documentElement;
$employee = @$employees->childNodes[$index];
$id = @$employee->childNodes[0]->nodeValue;
$name = @$employee->childNodes[1]->nodeValue;
$email = @$employee->childNodes[2]->nodeValue;
$phone = @$employee->childNodes[3]->nodeValue;
$address = @$employee->childNodes[4]->nodeValue;

require_once("views/view.php");