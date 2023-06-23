// get our elements

const evaulationText = document.querySelector('.evaludationText');
const evaluateButton = document.querySelector('.evaluate-button');

// make our evaluation button clickable
evaluateButton.addEventListener('click', () => {
    const cards = document.querySelectorAll('.card');
    const hand = validHand(cards);
    if (hand != false) {
        makeRequest(hand);
    }
});

// validate our hand
const validHand = (cards) => {
    // first make sure that none of the inputs are empty
    let validHand = true;
    cards.forEach(element => {
        if ( element.value == undefined 
            || element.value == null 
            || element.value == ''
        ) {
            validHand = false;
        }
    });
    
    if (validHand == false) {
        return validHand;
    }
    
    // make sure that we dont have any duplicates
    const hand = [];
    cards.forEach(element => {
        hand.push(element.value);
    })
    
    if (hand.length !== new Set(hand).size) {
        return false;
    }

    // return a valid hand
    return hand;
}

// make a request to our middleware layer
const makeRequest = async (hand) => {
    const url = `http://localhost/practice-projects/pocker-hand-evaluator-code-assessment/php-middleware/public/`;
    // request data
    const requestData = {
        card1: hand[0],
        card2: hand[1],
        card3: hand[2],
        card4: hand[3],
        card5: hand[4]
    };
    
    // attempt to make a post request
    const response = await fetch(url, {
        "method": "POST",
        "headers": {
            "Content-Type": "application/json"
        },
        "body": JSON.stringify(requestData)
    });

    // fetch the body and status code
    const {body, statusCode} = await response.json();
    
    // display the hand rank
    if (body.handRank != undefined && (statusCode != undefined && statusCode == 200)) {
        const handRank = body.handRank;
        evaulationText.innerHTML = null;
        evaulationText.innerHTML = `You have a "${handRank}" hand rank!`;
    }
} 
