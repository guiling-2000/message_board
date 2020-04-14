// ;(function () {

  // window.ajax = function () {
  //
  //   this.get = function (url) {
  //     var xhr = new XMLHttpRequest();
  //     xhr.open('GET', url);
  //     xhr.send();
  //     xhr.onreadystatechange = function () {
  //       if ( xhr.readyState == 4 && xhr.status ) {
  //         console.log(xhr.responseText);
  //         // return xhr.responseText;
  //       }
  //     };
  //   };
  //
  //   this.post = function (data = {}) {
  //     var xhr = new XMLHttpRequest();
  //     xhr.open('POST', data.url);
  //     xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  //     xhr.send();
  //     xhr.onreadystatechange = function () {
  //       if ( xhr.readyState == 4 && xhr.status ) {
  //         // console.log(xhr.responseText);
  //       }
  //     };
  //   };
  // };

  function Ajax() {};

  Ajax.prototype = {
    // method
    get: function (url, callback) {
      var xhr = new XMLHttpRequest();
      xhr.open('GET', url);
      xhr.send();
      xhr.onreadystatechange = function () {
        if ( xhr.readyState == 4 && xhr.status == 200 ) {
          callback(xhr.responseText); // 回调函数
        }
      };
    },

    post: function (url, callback) {
      var xhr = new XMLHttpRequest();
      xhr.open('POST', url);
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      xhr.send();
      xhr.onreadystatechange = function () {
        if ( xhr.readyState == 4 && xhr.status == 200 ) {
          callback(xhr.responseText); // 回调函数
        }
      };
    }
  };

// })();
