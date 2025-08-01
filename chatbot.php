<?php
function getBotResponse($message) {
    $message = strtolower($message);
    
    $responses = [
        'hello' => 'Hi! Please select one of the frequently asked questions below or type your question.',
        'hi' => 'Hello! You can click on any of the common questions below or ask your own question.',
        
        'what kind of destinations' => 'You can choose any destination for travel as per your mood. For an action-packed holiday, you can choose wildlife, trekking and other adventurous destinations. You can also choose the kind of holiday you want based on the destination you like—whether hills, mountains, beaches, heritage or pilgrimage sites.',
        
        'can i opt for a budget-friendly holiday' => 'Yes, you can. All you have to do is set an approximate expenditure amount in your mind before starting exploring the ideas here. You can search for a suitable destination for your travel in any range from Rs. 10,000 to Rs. 50,000. It is advisable to make all the bookings in advance in order to avoid change in prices.',
        
        'what will i get in a holiday idea' => 'Once you choose a destination, it will give you complete details of all the unique things about that place that must not be missed, including most visited local sites, best places to stay and all the memorable experiences that you can indulge in.',
        
        'show questions' => "Here are the frequently asked questions:\n
1. What kind of destinations can I choose for travelling?\n
2. Can I opt for a budget-friendly holiday?\n
3. What will I get in a holiday idea?",

        'default' => 'I can help you with common travel questions. Type "show questions" to see all frequently asked questions.'
    ];
    
    foreach ($responses as $keyword => $response) {
        if (strpos($message, $keyword) !== false) {
            return $response;
        }
    }
    
    return $responses['default'];
}

if (isset($_POST['message'])) {
    $userMessage = $_POST['message'];
    $response = getBotResponse($userMessage);
    echo $response;
    exit;
}

// Initial questions to display
$initial_questions = [
    "What kind of destinations can I choose for travelling?",
    "Can I opt for a budget-friendly holiday?",
    "What will I get in a holiday idea?"
];

if (!isset($_POST['message'])) {
    echo json_encode($initial_questions);
}
?>