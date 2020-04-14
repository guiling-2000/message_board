// 这里的 p 是一个元素节点
function Delete(element) {
  // var name = document.querySelector(p.nodeName + '+' + '.name').innerText;
  var name = element.nextElementSibling.innerText.trim();
  var url = 'delete.php?name=' + name;
  ajax.get(url, function (data) {
    console.log(data);
    if ( data ) element.parentNode.remove();
  });
}
