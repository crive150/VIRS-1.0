var mongoose = require('mongoose');

var KoneSchema = new mongoose.Schema({
    title: String,
    definition: String,
    frequency: {type: Number, default: 1}

});

mongoose.model('Kone', PostSchema);