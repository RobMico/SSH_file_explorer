const path = require('path');


const serverController = {
    connect: (req, res, next) => {
        return res.send("TODO");
    },

    execute: (req, res, next) => {
        return res.send("TODO");
    },

    getView: (req, res, next) => {
        return res.sendFile(path.resolve(__dirname, '..', '..', 'views', 'main.html'));
    },

    cloneSession: (req, res, next)=> {
        return res.send('Ok');
    }
}

module.exports = serverController;