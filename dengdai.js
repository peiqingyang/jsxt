// 获取表单元素和提交按钮元素
var form = document.querySelector('form');
var submitBtn = form.querySelector('input[type="submit"]');

// 禁用提交按钮


// 给表单的提交按钮添加事件监听器
form.addEventListener('submit', function(e) {
  // 创建弹窗元素
  var popup = document.createElement('div');
  popup.classList.add('popup');
  popup.textContent = '正在提交...';
  submitBtn.disabled = true;

  // 将弹窗添加到页面中
  document.body.appendChild(popup);

  // 关闭弹窗并启用提交按钮
  setTimeout(function() {
    document.body.removeChild(popup);
    submitBtn.disabled = false;
  }, 3000);

  // 阻止表单提交的默认行为
//   e.preventDefault();
});
