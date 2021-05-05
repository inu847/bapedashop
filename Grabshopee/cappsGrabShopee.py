import json
import requests
import subprocess
import os

def scrap(key):
    URLs = 'http://localhost/shopeeCurl.php?url='+key
    linkSuplier = requests.get(URLs)
    
    dataId = linkSuplier.json()
    userId = dataId['data']['userid']

    URL = 'http://127.0.0.1:8000/grabItems?url=https://shopee.co.id/api/v4/search/search_items?by=pop&limit=30&match_id='+ userId +'&newest=0&order=desc&page_type=shop&scenario=PAGE_OTHERS&version=2'
    getProduct = requests.get(URL)
    products = getProduct.json()
    for product in products['items']:
        itemId = product['item_basic']['itemid']
        shopid = product['item_basic']['shopid']
        name = product['item_basic']['name']
        price = product['item_basic']['price']

        print('Item ID : '+str(itemId)+'\nShopee Id : '+ str(shopid) +'\nProduct Name : '+ name+'\nPrice : '+ str(price))
        images = product['item_basic']['images']
        print('Json Images : ')
        for image in images:
            print('\t'+image)
            # Download Images
            try: 
                os.mkdir('images') 
            except: 
                pass
            response = requests.get("https://cf.shopee.co.id/file/"+image)
            file = open("images/"+image+'.jpg', "wb")
            file.write(response.content)
            file.close()
        try:
            variations = product['item_basic']['tier_variations']
            for variasi in variations:
                print(variasi['name'])
                options = variasi['options']
                for option in options:
                    print('\t'+option)
        except:
            options = ''
            print('Not Variations')

        writers = open('cappsGrab.txt', 'a+', encoding="utf-8")
        writers.writelines(f"{itemId}|{shopid}|{name}|{price}|{images}|{options}\n")
        writers.close()

def scrapByKeywoard():
    urls = open(r"LinkSupplierBlitar.txt", "r")
    keywoards = urls.readlines()
    # subprocess.Popen(['tor_proxy/Tor/tor.exe'])
    for key in keywoards:
        scrap(key)

if __name__ == '__main__':
    scrapByKeywoard()