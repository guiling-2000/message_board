  var ajax = new Ajax();
  // ajax.get('../info.php', function (data) {
  //   console.log(JSON.parse(data));
  // });
var a = document.getElementById('test');
// console.log(a);
a.onclick = function () {
  alert('click');
  ajax.get('info.php', function (data) {
    console.log(JSON.parse(data));
    console.log('ok');
  });

};
