import sys
import requests
import json
import os
import wget
import pymysql
import socket
import re

# 文章留言 http://dcard.tw/_api/posts/文章id/comments
# 從最新發布的留言抓 http://dcard.tw/_api/posts/文章id/comments?after=floor數字
#連接資料庫
db = pymysql.connect( host = 'localhost' ,user = 'taigun', passwd ='ELn3yv07F567MwOF', db = 'taigun')

if (db):
	print("connect!")
	cursor = db.cursor()


#偽裝成瀏覽器
header = { 
    'user-agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.110 Safari/537.36'
}

forum = ['food', 'makeup', 'travel', 'trending', 'funny', 'relationship', 'talk']


#將換行字元換成html語法，將圖片檔換成連結
def text_cleanup(text):
    new = ''    #新字元
    text.splitlines()   #分割句子
    space = text.splitlines()   #將分割的句子以list儲存
    x = 0   #itreator
   
    for t in text.splitlines():
        m1 = re.search('https.*jpeg',str(space[x]))
        photo = re.search('.*i.imgur.com.*',str(space[x]))
        m2 = re.search('https.*',str(space[x]))

        if(m1):
            p = '<img src="'+ t.rstrip() + '"><br><br>'
            new = new + p  
        elif(photo):
            alter = re.search('m/.*',str(space[x]))
            string = str(alter.group(0))
            pic = re.sub('m/', '', string)
            p = '<img src="https://imgur.dcard.tw/' + pic + '"><br><br>'
            new = new + p  
        elif(m2):
            p = '<a href ="' + t.rstrip() + '">Link</a><br><br>'
            new = new + p
        else:
            p = t.rstrip() + '<br><br>'
            new = new + p
            new = new.rstrip()
        x = x + 1
    return new

def find_id(text):
    reqjson = json.loads(text)
    ids = reqjson[i]["id"]
    ids = str(ids)
    return ids

def find_Article(ids):
    url = "https://www.dcard.tw/_api/posts/"+ids
    Article_req = requests.get(url, headers = header)
    reqjson = json.loads(Article_req.text)
    return reqjson

def find_Comments(ids):
    url = "http://dcard.tw/_api/posts/" + ids + "/comments"
    print(ids)
    comments_req = requests.get(url, headers = header)
    c_reqjson = json.loads(comments_req.text)
    return c_reqjson

#留言遭刪除
delete = '嗚嗚嗚。。該留言已遭刪除。。'


for m in range (0,7):
    
    url = "https://www.dcard.tw/_api/forums/"+forum[m]+"/posts?popular=true"
    orgin_req = requests.get(url, headers = header)

    if(int(orgin_req.status_code)==200):
        print("Dcard伺服器狀態:連線中")
    else:
        print("Dcard伺服器狀態:拍謝失敗捏")
        os.system("pause")
        os._exit()

    for i in range(0,10):
        
        #抓取文章的ID
        ids = find_id(orgin_req.text)
        #爬此篇文章
        reqjson = find_Article(ids)

        title = reqjson["title"]
        # title = text_cleanup(title) #標題會有非法字原要幫她去掉
        #print(title)

        excerpt = reqjson["excerpt"]
        # excerpt = text_cleanup(excerpt) #標題會有非法字原要幫她去掉
        #print(excerpt)

        content = reqjson["content"]
        content = text_cleanup(content) #標題會有非法字原要幫她去掉
        #print(content)

        date = reqjson["createdAt"]
        likecount = reqjson["likeCount"]
        category = reqjson["forumAlias"]

        if(db):
            sql = "INSERT INTO article(AId, category, UId, agree, content, title, excerpt, post_time, anonymous) VALUES (%s,%s,%s,%s,%s,%s,%s,%s,%s)"
            try:
                cursor.execute(sql,(ids,category,'0',likecount,content,title,excerpt,date,'0'))
                db.commit()
                print('article_success!')

            except:
                db.rollback()
                print('article_fail!')


        num = len(reqjson["topics"])
        print(num)
        if num != 0:
            for k in range(0,num):
                tag = reqjson["topics"][k]
                print(tag)
                if(db):
                    sql = "INSERT INTO article_tag(AId,tag) VALUES (%s,%s)"
                    try:
                        cursor.execute(sql,(ids,tag))
                        db.commit()
                        print('tag_success!')

                    except:
                        db.rollback()
                        print('tag_fail!')
        
        
        c_reqjson = find_Comments(ids)
        num = len(c_reqjson);
        if num > 10:
            num = 10
        

        for j in range(0,num):
            if(c_reqjson[j]):
                if((c_reqjson[j]["hidden"]) == False):
                    #留言內容
                    content = c_reqjson[j]["content"]
                    content = text_cleanup(content)
                    #按讚數
                    likecount = c_reqjson[j]["likeCount"]
                    #發布時間
                    date = c_reqjson[j]["createdAt"]
                    floor = c_reqjson[j]["floor"]
                    floor = int(floor)

                    if(db):
                        sql = "INSERT INTO comment(AId, UId, content, likeCount, time, anonymous, floor) VALUES (%s,%s,%s,%s,%s,%s,%s)"
                        try:
                            cursor.execute(sql,(ids,'0',content,likecount,date,'0',floor))
                            db.commit()
                            print('comment_success!')

                        except:
                            db.rollback()
                            print('fail!')

                else:
                    if((c_reqjson[j]["hidden"]) == True):
                        floor = floor + 1
                        if(db):
                            sql = "INSERT INTO comment(AId, UId, content, likeCount, time, anonymous, floor) VALUES (%s,%s,%s,%s,%s,%s,%s)"
                            try:
                                cursor.execute(sql,(ids,'0',delete,0,date,'2',floor))
                                db.commit()
                                print('comment_success!')

                            except:
                                db.rollback()
                                print('comment_fail!')

    
            
          









    
    


    
