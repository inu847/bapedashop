import os
import requests
import xlsxwriter
from bs4 import BeautifulSoup
from lxml import etree

def getprod(userid):
    try:
        os.mkdir('sheet')
    except:
        pass

    workbook = xlsxwriter.Workbook('sheet/'+userid+'.xlsx')
    worksheet = workbook.add_worksheet()
    # HEADER
    worksheet.write(0, 0, 'nama_product')
    worksheet.write(0, 1, 'deskripsi')
    worksheet.write(0, 2, 'price')
    worksheet.write(0, 3, 'image')
    worksheet.write(0, 3, 'stok')
    for page in range(0,2011,30):
        URL = 'http://127.0.0.1:8000/grabbingProduct2?username='+str(userid)+'&page='+str(page)
        print("[ INFO ]__main__ :"+URL)
        r = requests.get(URL)
        soup = BeautifulSoup(r.content, 'html5lib')
        dom = etree.HTML(str(soup))

        nama_products = dom.xpath('//*[@class="nama_product"]/text()')
        descriptions = dom.xpath('//*[@class="description"]/text()')
        images = dom.xpath('//*[@class="image"]/text()')
        stocks = dom.xpath('//*[@class="stock"]/text()')
        prices = dom.xpath('//*[@class="price"]/text()')

        if not nama_products:
            print("[ INFO ]__main__ : Finished Scrap")
            workbook.close()
            return False

        for nama_product, description, image, stock, price, x in zip(nama_products, descriptions, images, stocks, prices, range(page+1, page+31)):
            img = image.strip()

            # DOWNLOAD IMAGES
            # try: 
            #     os.mkdir('images') 
            # except: 
            #     pass
            # response = requests.get("https://cf.shopee.co.id/file/"+img)
            # file = open("images/"+image+'.jpg', "wb")
            # file.write(response.content)
            # file.close()

            for y in range(0, 4):
                if y == 0:
                    print("[ INFO ]__main__ :"+nama_product)
                    worksheet.write(x, y, nama_product)
                elif y == 1:
                    worksheet.write(x, y, description)
                elif y == 2:
                    worksheet.write(x, y, str(price))
                elif y == 3:
                    worksheet.write(x, y, img)
                elif y == 4:
                    worksheet.write(x, y, stock)
    workbook.close()

def user():
    urls = open(r"LinkSupplierBlitar.txt", "r")
    keywoards = urls.readlines()
    for key in keywoards:
        userid = key.replace('https://shopee.co.id/', '').strip()
        continued = getprod(userid)
        if not continued:
            continue
        
if __name__ == '__main__':
    user()