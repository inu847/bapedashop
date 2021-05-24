import json
import requests
import subprocess
import os
from lxml import etree
import xlsxwriter
import pandas as pd

def scrap(supplier): 
    name_products=[]
    prices=[]
    images=[]
    stocks=[]
    descriptions=[]
    for page in range(0,2011,30):
        URL = 'http://127.0.0.1:8000/api/grabbingProductShopee?username='+supplier+'&page='+str(page)
        print("[ INFO ]__main__ :"+URL)
        shopeeProduct = requests.get(URL)
        datas = shopeeProduct.json()
        if not datas:
            print("[ INFO ]__main__ : Selesai")
            break

        for data, x in zip(datas, range(page+1, page+len(datas))):
            name_products.append(data['product name'])
            prices.append(data['price'])
            images.append(data['image'])
            stocks.append(data['stock'])
            print("[ INFO ]__main__ :"+data['product name'])
            # try: 
            #     os.mkdir('images') 
            # except: 
            #     pass
            # response = requests.get("https://cf.shopee.co.id/file/"+image)
            # file = open("images/"+image+'.jpg', "wb")
            # file.write(response.content)
            # file.close()
            
            for product in data['item basic']:
                itemId = product['itemid']
                shopid = product['shopid']
                descriptions.append(product['description'])
                variations = product['tier_variations']

                for variasi in variations:
                    options = variasi['options']
                    for option in options:
                       print('\t'+option)
    df = pd.DataFrame({'nama_product': [name_product for name_product in name_products],
                        'price': [price for price in prices],
                        'image': [image for image in images],
                        'stock': [stock for stock in stocks],
                        'description': [description for description in descriptions]})

    writer = pd.ExcelWriter('sheetApi/'+supplier+'.xlsx', engine='xlsxwriter')
    df.to_excel(writer, sheet_name='Sheet1', index=False)
    writer.save()

def getProductShopeeBySupplier():
    try:
        os.mkdir('sheetApi')
    except:
        pass
    urls = open(r"LinkSupplierBlitar.txt", "r")
    keywoards = urls.readlines()
    for key in keywoards:
        supplier = key.replace('https://shopee.co.id/', '').strip()
        continued = scrap(supplier)
        if not continued:
            continue

if __name__ == '__main__':
    getProductShopeeBySupplier()