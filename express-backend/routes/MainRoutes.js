import EvaluatePockerHand from "../controllers/EvaluatePockerHand.js";

class MainRoutes {
     
    constructor(app) {
        this.app = app;
        this.routeMainName = '/pocker-evaluator/api/v1';
        this.evaluatePockerHand = new EvaluatePockerHand();
    }
    
    /**
     * this registers each route that we will use
     * if any of the routes are accessed it will call it's 
     * specific controller class and evaluate that particular pocker hand
     */
    reigsterRoutes() {
        this.app.post(`${this.routeMainName}/evaluate/hand`, (req, res) => {
            let cardsInHand = req.body;
            if (cardsInHand == null || cardsInHand == '') {
                res.status(400);
                return res.send({err : 'Missing request body'});
            }
            let result = this.evaluatePockerHand.evaluate(cardsInHand);
            res.status(200);
            return res.send(result);
        });
    }
}

export default MainRoutes;