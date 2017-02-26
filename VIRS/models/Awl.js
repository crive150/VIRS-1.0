var mongoose = require('mongoose');

var AwlSchema = new mongoose.Schema({
    title: String,
    definition: String,
    frequency: {type: Number, default: 1}

});

mongoose.model('Awl', AwlSchema);