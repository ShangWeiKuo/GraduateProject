system     : CentOS 7 
web        : ngimx+php-fpm 
ftp        : vsftpd
firewall   : iptables+fail2ban 
BD         : MySQL
Repository : Remi


原始檔案及SQL使用之帳號密碼 

FTP
    username: admin
    password: BZ76agROZh

SQL
    username: root
    password: BZ76agROZh



AllPass 網站管理員帳號密碼


SQL
    username: admin
    password: BZ76agROZh



在乾淨的CentOS 7下使用以下VestaCP腳本指令搭建環境



# Connect to your server as root via SSH
ssh root@your.server

# Download installation script
curl -O http://vestacp.com/pub/vst-install.sh

# Run it
bash vst-install.sh --nginx yes --phpfpm yes --apache no --named no --remi yes --vsftpd yes --proftpd no --iptables yes --fail2ban yes --quota no --exim no --dovecot no --spamassassin no --clamav no --softaculous yes --mysql yes --postgresql no


FTP/SQL帳號密碼 : 依照安裝腳本進行設置


1.登入 http://IP/phpmyadmin  匯入sql

2.進入http://IP:8083 登入創建網站目錄，以及SSL設置(若有綁定域名)

3.使用ftp進入網站目錄並匯入網站檔案

--

【PHP】

index.php			首頁

answer*.php			附屬於評論底下之留言處理相關
backend*.php			管理員後台圖表相關
class-info.php			課程資訊頁面
class-list.php			課程列表頁面
comment*.php			評論處理相關（棄置）
doAction.php, upload*.php	檔案上傳
edit-member.php			修改會員資料
favofite*.php			我的最愛處理相關
homework*.php			檔案上傳處理相關
member-page.php			我的最愛頁面
pythoninphp*.php		後台分析處理相關
question*.php			評論處理相關
register*.php			註冊處理相關
reset*.php			重設密碼處理相關
score-send.php			評分處理相關
tabpic*.php			後台圖表相關
teacher-info.php		以教師名稱搜尋之頁面
verify.php			認證處理頁面

content/			分別依檔名為根目錄相關頁面包裝之內容

function/do-login.php		登入處理頁面
function/do-logout.php		登出處理頁面
function/pw-hash.php		密碼雜湊運算頁面
function/token.php		許可通行碼產生頁面

part/backend*.php		後台相關頁面組件
part/footer.php			頁面底部之廣告區
part/header.php			頁面底部之搜尋欄區
part/nav.php			搜尋欄區內容定義
part/sidebar*.php		側欄
part/sql-connection.php		資料庫連線
