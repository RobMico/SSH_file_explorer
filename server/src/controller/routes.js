const router = require("express").Router();
const serverController = require('./serverController');

router.post('/api/connect', serverController.connect);
router.post('/api/execute', serverController.execute);
router.get('/', serverController.getView);

module.exports = router;