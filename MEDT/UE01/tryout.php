<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arrays und Superglobals</title>
</head>
<body>
    <h1>Arrays</h1>
    <h2>Task 1</h2>
    <?php 
    $stocks = ["APPL", "NVDA", "UBER"];
    $stocks[] = "TSL";
    $stocks[] = "SPY"; 
    ?>   
    <ul>
        <?php
        foreach($stocks as $stock){
            echo "<li>$stock</li>";
        }
        ?>
    </ul>

    <h2>Task 2</h2>
    <?php 
    $sales = [
        'Monday' => '120.5',
        'Tuesday' => '105.5',
        'Wednesday' => '95'
    ];
    $result = 0;
    ?>

    <ul>
        <?php
        foreach($sales as $day => $price){
            echo "<li>$day: $price €</li>"; 
            $result += $price;
        }
        echo "<p>Total sales: $result €</p>"
        ?>
    </ul>
    <h2>Task 3</h2>
    <?php 
    $students = [
        [
            'name' => 'Anna',
            'note' => '1'
        ],
        [
            'name' => 'Ben',
            'note' => '2'
        ],
        [
            'name' => 'Clara',
            'note' => '4'
        ]
    ];
    ?>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Note</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($students as $student){
                    echo "<tr>";
                    echo "<td>{$student['name']}</td>";
                    echo "<td>{$student['note']}</td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
</body>
</html>