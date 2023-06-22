// import pockersolve package  to help us evaludate our hand rank
import pockersolver from 'pokersolver';

class EvaluatePockerHand {
   
    constructor() {
        this.pockerSolver = pockersolver.Hand;
    }

    evaluate(cardsInHand) {
        let response = null
        let hand = this.pockerSolver.solve(cardsInHand);
        if (hand != null) {
            response = {
                handRank: hand.name,
                description: hand.descr
            };
        }
        return response;
    }
}

export default EvaluatePockerHand;