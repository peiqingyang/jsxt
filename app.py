from flask import Flask, request, render_template
import paramiko

app = Flask(__name__)

def execute_ssh_command(hostname, port, username, password, command):
    # 创建SSH客户端
    client = paramiko.SSHClient()
    # 自动添加主机密钥
    client.set_missing_host_key_policy(paramiko.AutoAddPolicy())
    # 连接SSH服务器
    client.connect(hostname, port=port, username=username, password=password)
    # 执行命令
    stdin, stdout, stderr = client.exec_command(command)
    # 获取命令输出
    output = stdout.read().decode('utf-8')
    # 关闭SSH连接
    client.close()
    return output

@app.route('/')
def index():
    return render_template('index.html')

@app.route('/ssh', methods=['POST'])
def ssh():
    ip = request.form['ip']
    username = request.form['username']