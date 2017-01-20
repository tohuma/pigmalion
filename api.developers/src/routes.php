<?php
// Routes

function money($amount)
{
    return floatval(preg_replace('/[^\d\.]/', '', $amount));
}

function generateEmployeesXML($employees)
{
    $xml = new SimpleXMLElement('<root/>');
    foreach ($employees as $employee) {
        $item = $xml->addChild('employee');
        $item->addChild('id', $employee->id);
        $item->addChild('isOnline', $employee->isOnline);
        $item->addChild('salary', $employee->salary);
        $item->addChild('age', $employee->age);
        $item->addChild('name', $employee->name);
        $item->addChild('gender', $employee->gender);
        $item->addChild('email', $employee->email);
        $item->addChild('phone', $employee->phone);
        $item->addChild('address', $employee->address);

        $skills = $item->addChild('skills');
        foreach( $employee->skills as $node ) {
            $skills->addChild('skill', $node->skill);
        }
    }

    return $xml;
}

function getEmployees()
{
    return json_decode(file_get_contents('employees.json'));
}

function search($employees = [], $min = null, $max = null)
{
    $data = [];
    foreach ($employees as $employee ) {
        $salary = money($employee->salary);
        if ( $salary >= $min && $salary <= $max ) {
            $data[] = $employee;
        }
    }

    return $data;
}

$app->get('/', function ($request, $response, $args) {

    return 'Slim framework';
});

$app->get('/employees', function ($request, $response, $args) use ($app) {
    $salary = explode(',', $request->getQueryParam('salary'));
    $min = isset($salary[0]) ? $salary[0] : null;
    $max = isset($salary[1]) ? $salary[1] : null;

    $employees = getEmployees();
    if( !is_null($min) && !is_null($max) ) {
        $employees = search($employees, $min, $max);
    }

	$response->withHeader('Content-Type', 'application/xml');
    $xml = generateEmployeesXML($employees);

	return $xml->asXml();

});
