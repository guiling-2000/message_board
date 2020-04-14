function callback(data) {
  var content = JSON.parse(data);
  // 留言条数
  var total = content.info.total_nums;
  if ( total === 0 ){
    alert('当前还没有留言');
    return;
  }
  // 留言 页数
  var page = Math.ceil( total / content.info.page_size );

  message(content);
  pagination(page);
}

function message(content) {
  var data = content.info.data;
  var parent = document.getElementsByClassName('message')[0];

  for ( let i = 0; i < data.length; i++ ) {
    var item = document.createElement('div');
    item.className = 'message_item';
    item.innerHTML = '<button onclick="deleteItem(this, event)" data-id="' + data[i].id + '">删除</button>' +
                     '<div class="name">' + data[i].name + '</div>' +
                     '<div class="time">' + data[i].message_time + '</div>' +
                     '<div class="content">' + data[i].content + '</div>';
    parent.appendChild(item);
  }

}

function pagination(page) {
  var newElement = document.createElement('div');
  newElement.className = 'pagination';
  var targetElement = document.getElementsByClassName('container')[0];

  insertAfter(newElement, targetElement);

  for ( let i = 1; i <= page; i++ ) {
    var a = document.createElement('a');
    a.href = 'javascript:void(0)';
    a.setAttribute('onclick', 'run(this)');
    a.innerText = i;
    newElement.appendChild(a);
  }
}

//利用js提供的insertBefore及过滤器nextSibling\parentNode等
function insertAfter(newElement, targetElement) {
    var parent = targetElement.parentNode;
    //如果目标元素是其父元素的最后一个元素节点，直接插newElement
    //否则，在目标元素的下一个兄弟元素之前插入
    if (parent.lastChild == targetElement) {
        parent.appendChild(newElement);
    } else {
        parent.insertBefore(newElement, targetElement.nextElementSibling);
    }
}

function run(element) {
  // 为分页添加 active 效果
  var page = document.getElementsByClassName('pagination')[0].children;
  for ( let i = 0; i < page.length; i++ ) page[i].className = '';
  element.className = 'active';

  /*
   * 这里 item.length 在 遍历 时动态变化，
   * 因此在开始时就 赋值给一个变量，这样值就不会动态变化了
   * 遍历 移除 第一个子元素
   */
  var item = document.getElementsByClassName('message_item');
  var len = item.length;
  for ( let i = 0; i < len; i++ ) {
    item[0].remove();
  }

  var id = element.innerText.trim();
  ajax.get('info.php?id='+id, function (data) {
    message(JSON.parse(data));
  });
}

function deleteItem(element, event) {
  // console.log(event.target.dataset)
  // var name = element.nextElementSibling.innerText.trim();
  var url = 'delete.php?id=' + event.target.dataset.id;
  ajax.get(url, function (data) {
    console.log(data);
    if ( data ) element.parentNode.remove();
  });
}

var ajax = new Ajax();
ajax.get('info.php', callback);

/*
 * notice: 异步和同步的问题
 * 在这里，拿不到 分页节点 ( undefined ), 因为 异步的原因，document 还没有加载完成
 * var page = document.getElementsByClassName('pagination')[0]; // undefined
 * 因此，只有当 document 加载完毕才好去操作 DOM
 * 这里用到了 事件处理函数
 */
