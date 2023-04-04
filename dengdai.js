// 获取表单元素和提交按钮元素
var form = document.querySelector('form');
var submitBtn = form.querySelector('input[type="submit"]');

document.head.appendChild(style);
// 禁用提交按钮
var style = document.createElement('style');



// 给表单的提交按钮添加事件监听器
form.addEventListener('submit', function(e) {
  style.innerHTML = `
.popup {
  position: absolute;
  left: 182px;
  top: 86.8px;
  width: 308px;
  height: 107px;
  opacity: 1;
  font-size: 73.3px;
  font-weight: 700;
  letter-spacing: 0px;
  line-height: 0px;
  color: rgba(0, 216, 255, 1);
  text-align: center;
  vertical-align: top;
}
`;
  // 创建弹窗元素
  var popup = document.createElement('div');
  popup.classList.add('popup');
  popup.textContent = '正在提交...';
  submitBtn.disabled = true;

  // 将弹窗添加到页面中
  document.body.appendChild(popup);
  var style = document.createElement('style');
  style.innerHTML = `
  .popup {
    position: absolute;
    left: 182px;
    top: 86.8px;
    width: 308px;
    height: 107px;
    opacity: 1;
    font-size: 73.3px;
    font-weight: 700;
    letter-spacing: 0px;
    line-height: 0px;
    color: rgba(0, 216, 255, 1);
    text-align: center;
    vertical-align: top;
  }
  `;
  document.head.appendChild(style);
  
  // 关闭弹窗并启用提交按钮
  setTimeout(function() {
    document.body.removeChild(popup);
    submitBtn.disabled = false;
  }, 10000);

  // 阻止表单提交的默认行为
//   e.preventDefault();
});
