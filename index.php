<?php
require("fpdf.php");

// Create instance of FPDF
$pdf = new FPDF();

// Start output buffering to capture any output
ob_start();

// Add PDF content
$pdf->AddPage();
$pdf->SetFont("Arial", "B", 17);
$pdf->SetTextColor(0,128,0);
$pdf->Cell(71,10, '',0,0);
$pdf->cell(59,5, 'ALLIANCE GIRLS HIGHSCHOOL',0.0);
$pdf->cell(59,10, '',0,1);

$pdf->SetFont('Arial', 'B', 15);

$pdf->SetTextColor(0,128,0);
$pdf->cell(71,5, 'FAX  020-20125',0,0);
$pdf->cell(59,5, '',0,0);
$pdf->cell(59,5,'email:info@alliancegirls.sc.ke',0,1);

$pdf->SetFont('Arial', 'B', 10);

$pdf->cell(130,5, 'CELL: 0736654663',0,0);
$pdf->cell(25,5, 'web:alliancegirl.com.',0,0);
$pdf->cell(34,5, '',0,1);

$pdf->SetFont('Arial', '', 10);
$pdf->cell(130,5, 'PO BOX 10300-425',0,0);
$pdf->cell(130,10, '',0,1);

$pdf->setLineWidth(1.5);
$pdf->Ln();  // Move to the next line
$pdf->Cell(190.20, 0, '', 'T');  // Draw a line

$pdf->Ln(10);


$pdf->SetTextColor(0,0,0);
$pdf->cell(130,5, 'Ref No:...........',0,0);
$pdf->cell(25,5, '',0,0);
$pdf->cell(34,5, 'Date:...........',0,1);


$pdf->SetFont('Arial', 'B', 15);
$pdf->SetTextColor(0,0,0);
$pdf->cell(130,20, 'DEAR:...........',0,0);
$pdf->cell(25,20, '',0,0);
$pdf->cell(34,20, 'YEAR:2024',0,1);

$pdf->SetFont('Arial', '', 10);
$sentence = "I am pleased to inform you that you have been selected to join form one in our school, Congratulations.";
$pdf->Cell(170, 10, $sentence, 0, 1, 'C');  // '0' for auto width

$pdf->SetFont('Arial', '', 10);
$sentence = "Please get your Primary School's Head teacher to endorse the letter in the spaces provided below.";
$pdf->Cell(170, 10, $sentence, 0, 1, 'C');  // '0' for auto width

// Database connection parameters
$servername = "localhost"; // Change this to your MySQL server address
$username = "root"; // Change this to your MySQL username
$password = ""; // Change this to your MySQL password
$database = "students"; // Change this to your MySQL database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to retrieve student names and index numbers
$sql = "SELECT name, indexnumber, marks, primaryschool, Headteacher, RefNo FROM student";
$result = $conn->query($sql);





if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        // Populate PDF with student name and index number
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(80, 10, 'Student Name:..... ' . $row["name"], 0, 0);
        $pdf->Cell(59, 10, 'Index Number:..... ' . $row["indexnumber"], 0, 0);
        $pdf->cell(34,10, 'Marks:..... ' . $row["marks"],0,1);



        $pdf->SetFont('Arial', '', 10);
        $pdf->cell(80,10, 'Primary School:...'. $row["primaryschool"],0,0);
        $pdf->cell(59,10, '',0,0);
        $pdf->cell(34,10, ' ',0,1);


        $pdf->SetFont('Arial', '', 10);
        $pdf->cell(80,20, 'Head teachers Name:.....'. $row["Headteacher"],0,0);
        $pdf->cell(59,20, '',0,0);
        $pdf->cell(34,20, ' ',0,1);

    }
} else {
    echo "0 results";
    
}

// Close database connection
$conn->close();



$pdf->SetFont('Arial', '', 10);
$pdf->cell(80,20, 'Head teachers Signature:..........................',0,0);
$pdf->cell(59,20, 'Date:................................',0,0);
$pdf->cell(34,20, ' ',0,1);

$pdf->SetFont('Arial', '', 10);
$pdf->cell(80,20, 'Students Signature:...............................',0,0);
$pdf->cell(59,20, 'Date:...........................',0,0);
$pdf->cell(34,20, ' ',0,1);


$paragraph = "Disclaimer: This letter will be authenticated on being duly certified by the primary school head complete with a certified copy of birth certificate and finally confirmed by the admitting principal. The letter is issued without any erasure  or alteration and cannot be changed through any form of endorsement whatsoever; utterance of false documents is an offence punishable by law.";

$pdf->MultiCell(0, 10, $paragraph);

// Add second page
$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 15);
$pdf->SetTextColor(0,0,0);
$pdf->cell(130,5, 'FORM ONE ADMISSION-2024',0,0);
$pdf->cell(25,5, '',0,0);
$pdf->cell(34,5, '',0,1);

$pdf->SetFont('Arial', '', 10);
$paragraph = "Alliance Girls High School was the first African Girls Secondary School in Kenya.  It was founded by the Alliance of Protestant Missionaries; hence the name.  The Presbyterian Church of East Africa gave the land and are the sponsors. The first ten girls arrived on  February, 28th 1948.  These girls were drawn from all the Provinces in the Republic.  This National outlook has been retained to date. The school has a strong Christian Tradition and way of life.";
$pdf->MultiCell(0, 10, $paragraph);

$pdf->SetFont('Arial', 'B', 15);
$pdf->SetTextColor(0,0,0);
$pdf->cell(130,5, 'Location of the School',0,0);
$pdf->cell(25,5, '',0,0);
$pdf->cell(34,5, '',0,1);

$pdf->SetFont('Arial', '', 10);
$paragraph = " The School is situated in Kikuyu near the P.C.E.A Kikuyu Hospital. If using public service vehicles from Nairobi, board a matatu or City Shuttle bus No.105 from Kenya National Archives (Commercial) Bus Stage to Kikuyu town then board matatu No.102 and alight at the Alliance or PCEA Hospital Bus Stage and walk to the school.

Enclosed find more general information about the school and requirements for admission.
We look forward to receiving you at the school.

Yours faithfully,
Jedidah Mwangi (Mrs.)
.";
$pdf->MultiCell(0, 10, $paragraph);

$pdf->SetFont('Arial', 'BU', 10);
$pdf->SetTextColor(0,0,0);
$pdf->cell(130,10, 'CHIEF PRINCIPAL',0,0);
$pdf->cell(25,5, '',0,0);
$pdf->cell(34,5, '',0,1);

$pdf->SetFont('Arial', 'BU', 10);
$pdf->SetTextColor(0,0,0);
$pdf->cell(130,20, 'REQUIREMENTS',0,0);
$pdf->cell(25,20, '',0,0);
$pdf->cell(34,20, '',0,1);

$pdf->SetFont('Arial', 'B', 15);
$pdf->SetTextColor(0,0,0);
$pdf->cell(130,5, '1. Documents',0,0);
$pdf->cell(25,5, '',0,0);
$pdf->cell(34,5, '',0,1);

$pdf->SetFont('Arial', '', 10);

// Define the list of items
$items = array(
    "One Bible (Revised Standard Version)",
    "One Mathematical Set",
    "General stationery items (e.g. biro pens, pencils, erasers e.t.c.)"
);

// Loop through the items and display them as an ordered list
foreach ($items as $key => $item) {
    $pdf->Cell(0, 10, ($key + 1) . ". " . $item, 0, 1);
}

$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(0,0,0);
$pdf->cell(130,5, 'II. Clothing ',0,0);
$pdf->cell(25,5, '',0,0);
$pdf->cell(34,5, '',0,1);

$pdf->SetFont('Arial', '', 10);

// Define the list of items
$items = array(
    "Uniform is compulsory and home clothes are not allowed. ",
    "2 green skirts",
    "3 white tie collar blouses (1 long sleeved, 2 short sleeved)",
    "1 P.E kit",
    "A swimsuit",
    "2 green V-neck jerseys with school logo long sleeved",
    "1 green V-neck Jersey - sleeveless",
    "1 tie",
    "2 pairs of socks",
    "1 white T-shirt with logo",
    "1 green V-neck Jersey - sleeveless",
    "A pair Navy blue trousers - girls  (out of class uniform)",
    "1 bedcover",
    "1 pair of leg-warmers",
    "1 scarf",
    "1 mattress",
    "1 green fleece  jacket",
    "1 tracksuit (out of school wear especially in the evenings)"
);
// Loop through the items and display them as an ordered list
foreach ($items as $key => $item) {
    $pdf->Cell(0, 5, ($key + 1) . ". " . $item, 0, 1);
}

$pdf->SetFont('Arial', 'B', 15);
$pdf->SetTextColor(0,0,0);
$pdf->cell(130,5, 'Location of the School',0,0);
$pdf->cell(25,5, '',0,0);
$pdf->cell(34,5, '',0,1);

$pdf->SetFont('Arial', '', 10);
$paragraph = " Have Ksh 1000 for printing of the admission number on your daughters items and Ksh 700 for 3 visitors cards and a school identity card..
NB: Students will report dressed in their former primary school uniform and bring an extra set of the same.

.";
$pdf->MultiCell(0, 10, $paragraph);

$pdf->SetFont('Arial', 'B', 15);
$pdf->SetTextColor(0,0,0);
$pdf->cell(130,5, '2. Extra Clothing and Bedding to be brought',0,0);
$pdf->cell(25,5, '',0,0);
$pdf->cell(34,5, '',0,1);

$pdf->SetFont('Arial', '', 10);

// Define the list of items
$items = array(
    "2 plain short sleeved T-shirts   white ",
    "2 plain long sleeved T-shirts ",
    "2 pairs of low heeled black shoes ",
    "1 pair of black sandals  (Bata brown hazel sandals)",
    "1 pair of white/black canvas shoes (Bata Bullets) for games ",
    "2 black panties to wear with P.E. Kit",
    "Sufficient under-clothing ",
    "2 nightdresses or pairs of pajamas",
    "3 blankets not duvets ",
    "2 towels",
    "2 pairs of plain bed sheets",
    "1 pillow and 2 pillow cases",
    "Toiletries (e.g. adequate amounts of toothpaste, bathing soap, sanitary towels, washing soap, toilet paper, toothbrush, shoe polish, comb e.t.c.)",
    "3 buckets (2 small and 1 large)",
    "3 quality padlocks",
    "1 umbrella (no raincoats)",
);
// Loop through the items and display them as an ordered list
foreach ($items as $key => $item) {
    $pdf->Cell(0, 5, ($key + 1) . ". " . $item, 0, 1);
}


$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(0,0,0);
$pdf->cell(130,10, 'III. Food Items ',0,0);
$pdf->cell(25,5, '',0,0);
$pdf->cell(34,5, '',0,1);

$pdf->SetFont('Arial', '', 10);
$paragraph = " The following are the authorized items to be brought to school as specified and will only be replenished during half-term.
.";
$pdf->MultiCell(0, 10, $paragraph);

$pdf->SetFont('Arial', '', 10);

// Define the list of items
$items = array(
    "Beverage (500g of cocoa/coffee/drinking chocolate)- no flavoured tea bags ",
    "Sugar (2kgs)",
    "Biscuits (2kg) - no cookies ",
    "Bread spread (500g of Jam/Margarine)",
);
// Loop through the items and display them as an ordered list
foreach ($items as $key => $item) {
    $pdf->Cell(0, 5, ($key + 1) . ". " . $item, 0, 1);
}

$pdf->SetFont('Arial', '', 10);
$pdf->SetTextColor(0,0,0);
$pdf->cell(130,10, 'Students may also bring the following crockery and cutlery.',0,0);
$pdf->cell(25,5, '',0,0);
$pdf->cell(34,5, '',0,1);

$pdf->SetFont('Arial', '', 10);

// Define the list of items
$items = array(
    "1 melamine side plate ",
    "1 mug",
    "1 teaspoon ",
    "1 tablespoon",
    "1 thermos Cup",
);
// Loop through the items and display them as an ordered list
foreach ($items as $key => $item) {
    $pdf->Cell(20, 6, ($key + 1) . ". " . $item, 0, 1);
}

$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(0,0,0);
$pdf->cell(130,10, 'IV. Others',0,0);
$pdf->cell(25,5, '',0,0);
$pdf->cell(34,5, '',0,1);

$pdf->SetFont('Arial', '', 10);
$paragraph = " a)  Pocket Money - About Ksh1,000.00 per term should be deposited with the housemistress in the evening of arrival. We will process students’ KCB Smart Cards for pocket money.
.";
$pdf->MultiCell(0, 5, $paragraph);

$pdf->SetFont('Arial', '', 10);
$paragraph = " b) Travel Money – All students who use public service vehicles should deposit this money with the housemistress to facilitate end of term and mid term  travel back home.
.";
$pdf->MultiCell(0, 10, $paragraph);

$pdf->SetFont('Arial', 'B', 15);
$pdf->SetTextColor(0,0,0);
$pdf->cell(130,5, '3. Diet',0,0);
$pdf->cell(25,5, '',0,0);
$pdf->cell(34,5, '',0,1);

$pdf->SetFont('Arial', '', 10);
$paragraph = " The school provides a simple and wholesome diet. Due to limitations, we regret that students with special diet needs cannot be catered for.";
$pdf->MultiCell(0, 10, $paragraph);

$pdf->SetFont('Arial', 'B', 15);
$pdf->SetTextColor(0,0,0);
$pdf->cell(130,5, '4. Cleaning/Tidying Up/Community Work Duties',0,0);
$pdf->cell(25,5, '',0,0);
$pdf->cell(34,5, '',0,1);

$pdf->SetFont('Arial', '', 10);
$paragraph = " All girls are responsible for cleaning and tidying up their dormitories, classes and other areas in the school compound. For this; each student must bring:-";
$pdf->MultiCell(0, 10, $paragraph);

$pdf->SetFont('Arial', 'B', 15);
$pdf->SetTextColor(0,0,0);
$pdf->cell(130,5, '5. Clubs, Societies and Games ',0,0);
$pdf->cell(25,5, '',0,0);
$pdf->cell(34,5, '',0,1);


$pdf->SetFont('Arial', '', 10);
$paragraph = " There are many of these in the school and students are expected to make choices to belong to at least one of them.:-";
$pdf->MultiCell(0, 10, $paragraph);

$pdf->SetFont('Arial', 'B', 15);
$pdf->SetTextColor(0,0,0);
$pdf->cell(130,5, '6. Form One Parents Orientation Meeting ',0,0);
$pdf->cell(25,5, '',0,0);
$pdf->cell(34,5, '',0,1);

$pdf->SetFont('Arial', '', 10);
$paragraph = " There will be a form one parents orientation meeting which will be communicated later. Please note that this is not a visiting day and no food should be brought to school.";
$pdf->MultiCell(0, 10, $paragraph);

$pdf->SetFont('Arial', 'B', 15);
$pdf->SetTextColor(0,0,0);
$pdf->cell(130,5, 'SCHOOL RULES AND REGULATIONS ',0,0);
$pdf->cell(25,5, '',0,0);
$pdf->cell(34,5, '',0,1);

$pdf->SetFont('Arial', 'B', 15);
$pdf->SetTextColor(0,0,0);
$pdf->cell(130,5, 'Background ',0,0);
$pdf->cell(25,5, '',0,0);
$pdf->cell(34,5, '',0,1);

$pdf->SetFont('Arial', '', 10);
$paragraph = " AGHS is a national school for girls that was founded in 1948 by the Alliance of Protestant Missionaries. The school is sponsored by the Presbyterian Church of East Africa and hence has strong Christian traditions and values. Students are drawn from all parts of the country..";
$pdf->MultiCell(0, 10, $paragraph);

$items = array(
    "Show respect at all times (for God, authority, peers and all property)",
    "Adhere to school routine and carry out assigned duties diligently. Observe punctuality at all times. ",
    "Attendance of parade, chapel lessons and preps is compulsory for all students.",
    "Maintain silence in class and tuition areas at all times. Shouting and screaming along the corridors is prohibited.",
    "No student may leave the school without authority to do so.",
    "PROHIBITED AREAS.",
);
// Loop through the items and display them as an ordered list
foreach ($items as $key => $item) {
    $pdf->Cell(20, 6, ($key + 1) . ". " . $item, 0, 1);
}

$pdf->SetFont('Arial', '', 10);
$sentence = " (i)Staff quarters (except in case of emergency).";
$pdf->Cell(170, 10, $sentence, 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$sentence = " (ii)School farm (unless with permission).";
$pdf->Cell(170, 10, $sentence, 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$sentence = " (iii)Netball and Hockey pitches (not after 6:00pm.";
$pdf->Cell(170, 10, $sentence, 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$sentence = " (iv)Driveway (beyond the white stone wall).";
$pdf->Cell(170, 10, $sentence, 0, 1, 'C');

$pdf->SetFont('Arial', 'B', 15);
$pdf->SetTextColor(0,0,0);
$pdf->cell(130,5, '7. Students must always carry school identity cards. ',0,0);
$pdf->cell(25,5, '',0,0);
$pdf->cell(34,5, '',0,1);

$pdf->SetFont('Arial', 'B', 10);
$paragraph = " 8. Students must carry themselves with respect and dignity when involved in representing the school in activities within or outside the school.";
$pdf->MultiCell(0, 5, $paragraph);

$pdf->SetFont('Arial', 'B', 10);
$paragraph = " 9. School uniform must be kept neat and clean. Jewelry should not be worn with school uniform.";
$pdf->MultiCell(0, 5, $paragraph);

$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(0,0,0);
$pdf->cell(130,5, '10. The following are optional:.',0,0);
$pdf->cell(25,5, '',0,0);
$pdf->cell(34,5, '',0,1);

$pdf->SetFont('Arial', '', 10);
$sentence = " (i)Clear nail varnish on the toe nails only.";
$pdf->Cell(100, 10, $sentence, 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$sentence = " (ii)Small plain studs without stone (one on each ear lobe).";
$pdf->Cell(110, 10, $sentence, 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$sentence = " (iii)Small plain black hair bands (not shiny). Alice bands are not allowed";
$pdf->Cell(130, 10, $sentence, 0, 1, 'C');

$pdf->SetFont('Arial', 'B', 10);
$paragraph = " 11. Hair should be maintained straight. Plaiting is allowed (maximum of 8 cornrows and minimum of 4) from Monday to Saturday. Hair should be combed out and neatly tied at the back on Sunday and on any outing.";
$pdf->MultiCell(0, 5, $paragraph);

$pdf->SetFont('Arial', 'B', 10);
$paragraph = " 12. Dress decently at all times. Sandals (not slippers) could be worn in the Dinning Hall and tuition area  after classes.";
$pdf->MultiCell(0, 5, $paragraph);

$pdf->SetFont('Arial', 'B', 10);
$paragraph = " 13. No electronic devices, such as mobile phones, flash disks or any form of pornographic material should be brought to the school.";
$pdf->MultiCell(0, 5, $paragraph);

$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(0,0,0);
$pdf->cell(130,5, '14. The use, abuse and trafficking of alcohol or addictive substances is prohibited.',0,0);
$pdf->cell(25,5, '',0,0);
$pdf->cell(34,5, '',0,1);

$pdf->SetFont('Arial', 'B', 10);
$paragraph = " 15. Food and utensils should not be carried out of the Dining Hall. Neither should food from elsewhere be brought into the Dinning Hall.";
$pdf->MultiCell(0, 5, $paragraph);

$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(0,0,0);
$pdf->cell(130,5, '16. Chewing, eating, combing or plaiting hair is not allowed in the tuition area.',0,0);
$pdf->cell(25,5, '',0,0);
$pdf->cell(34,5, '',0,1);

$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(0,0,0);
$pdf->cell(130,5, '17. Keep off the grass. Dispose litter in designated areas or bins.',0,0);
$pdf->cell(25,5, '',0,0);
$pdf->cell(34,5, '',0,1);

$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(0,0,0);
$pdf->cell(130,5, '18. No student may move away furniture unless authorized.',0,0);
$pdf->cell(25,5, '',0,0);
$pdf->cell(34,5, '',0,1);

$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(0,0,0);
$pdf->cell(130,5, '19. English and Kiswahili languages are the medium of communication. Abusive language is not allowed.',0,0);
$pdf->cell(25,5, '',0,0);
$pdf->cell(34,5, '',0,1);

$pdf->SetFont('Arial', 'B', 10);
$paragraph = " 20. Any form of bullying (physical or psychological) of other students, violence and fighting is not allowed. Staring and screaming at others is not allowed..";
$pdf->MultiCell(0, 5, $paragraph);

$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(0,0,0);
$pdf->cell(130,5, '22. Visiting days:-',0,0);
$pdf->cell(25,5, '',0,0);
$pdf->cell(34,5, '',0,1);

$pdf->SetFont('Arial', '', 10);
$sentence = " (i)Visiting begins at 10:30 a.m.";
$pdf->Cell(90, 10, $sentence, 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$sentence = " (ii)Students receiving visitors must be dressed in full school uniform.";
$pdf->Cell(110, 10, $sentence, 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$paragraph = " (iii). Visitors vehicles are parked in the hockey field. All visitors and students should be at the Hockey field, volleyball pitch and basketball court.";
$pdf->MultiCell(0, 5, $paragraph);
$sentence = " (iv)Visitors are not allowed in the dormitory area or teachers quarters.";
$pdf->Cell(110, 10, $sentence, 0, 1, 'C');

$pdf->SetFont('Arial', 'B', 15);
$pdf->SetTextColor(0,0,0);
$pdf->cell(130,5, 'exeats.',0,0);
$pdf->cell(25,5, '',0,0);
$pdf->cell(34,5, '',0,1);

$pdf->SetFont('Arial', '', 10);
$sentence = " (i)Weddings - for the members of the immediate family. (No sleeping out).";
$pdf->Cell(110, 10, $sentence, 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$sentence = " (ii)Prize giving    -   No sleeping out.";
$pdf->Cell(110, 10, $sentence, 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$sentence = " (iii)Burial Each case is treated on its own merit.";
$pdf->Cell(110, 10, $sentence, 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$sentence = " (iv)Medical.";
$pdf->Cell(110, 10, $sentence, 0, 1, 'C');







// Add second page
$pdf->AddPage();

// End output buffering and discard any captured output
ob_end_clean();

// Output the PDF
$pdf->Output();
?>
