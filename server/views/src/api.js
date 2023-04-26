import { API_URL, connect_URL, sendCommand_URL } from '../config.js';

export const API = {
    checkLink() {
        if (!API_URL) {
            throw new Error('API_URL not defined');
            //return false;
        }
        return true;
    },
    async connect(formData) {
        API.checkLink();
        return '';
        //let xhr = new XMLHttpRequest();
        const result = await fetch(connect_URL, {
            method: 'POST',
            body: formData
        });
        return result;
    },
    async sendCommand(command) {
        
        API.checkLink();
        //let xhr = new XMLHttpRequest();
        const result = await fetch(sendCommand_URL, {
            method: 'POST',
            body: command
        });
        return result;
    }
};