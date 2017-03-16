 VM Guest OS的Lan IP  : 192.168.153.32

# Week : 2
## Project ： application

### 功能:
     1.使用者註冊帳號密碼及Google-Oauthe(包含QR-code、secretkey)
     2.先用帳密登入後再用Google-Oauth二次驗證
     3.經過二次驗證後，才可以使用google map

### Route:
     1. http://192.168.153.32/application/public/registerSecond
        說明：帳戶註冊完畢後，會跳出一張QR-code給使用者掃描及儲存
        完成日期：2017/03/08

     2. http://192.168.153.32/application/public/secondVerify
        說明：當使用者要login時的二次驗證
        完成日期：2017/03/08

     3. http://192.168.153.32/application/public/secondVerifyEnter
        說明：送出驗證資料，驗證登入資訊是否正確
        完成日期：2017/03/08

     4. http://192.168.153.32/application/public/mapUserAddress
        說明：完成驗證後，允許使用googlemap功能
        完成日期：2017/03/07



