function test() {
    alert('Test!');
    console.log('I am called!');
}

function createDeviceForm() {
    var temp = document.getElementsByTagName("template")[0];
    var clon = temp.content.cloneNode(true);
    document.getElementById("addDevice").appendChild(clon);
}

function showContent(elementId) {
    var temp = document.getElementsByTagName("template")[0];
    var clon = temp.content.cloneNode(true);
    document.getElementById(elementId).appendChild(clon);
}

function checkScanInput(event) {
    var str = document.getElementById("testinput");
    var x = event.charCode || event.keyCode;
    var y = String.fromCharCode(x);
//    console.log('x is ' + x + ' y is ' + y);

    if (str.value.match(/[^0-9,]/g)) {
        alert('Only digits are allowed.');
    }
    else if (y === ',') {
        console.log('the whole string is ' + str.value);
        var res = str.value.split(",");
        res.forEach(checkLength);
        var last = res.pop();
        console.log('last element is ' + last);
        checkDuplicate(res, last);
    }
}

function checkLength(value, index, array) {
    console.log('checking length of ' + value + ' length is ' + value.length);
    if (value.length != 15) {
        alert("This number shall be 15-digit: " + value);
    }
}

function checkDuplicate(items, last) {
    console.log('checkDuplicate is called, last is ' + last);
    items.forEach(function(value, index, array){
        if (value == last) {
            alert('This value already exists in the list ' + value);
        }
    });
}

