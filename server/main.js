const express = require('express');
const routes = require('./src/controller/routes');
const app = express();
const port = 7575;

app.use(routes);

//app.set('views', __dirname+'/views');

app.use(express.static('views'));

app.listen(port, () => {
  console.log(`Example app listening on port ${port}`);
});