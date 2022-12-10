var loadFile = function(event) {
    var output = document.getElementById('output');
    output.classList.add('fill-container');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src)
    }
};