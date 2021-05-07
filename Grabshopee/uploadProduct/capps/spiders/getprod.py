import scrapy
from scrapy.http import Request
import os
import requests

class GetprodSpider(scrapy.Spider):
    name = 'getprod'
    #allowed_domains = ['capps.com']
    start_urls = ['http://127.0.0.1:8000/grabbingProduct2/']

    def parse(self, response):
        urls = open(r"LinkSupplierBlitar.txt", "r")
        keywoards = urls.readlines()
        for key in keywoards:
            userid = key.replace('https://shopee.co.id/', '').strip()
            for page in range(0,90,30):
                
                URL = 'http://127.0.0.1:8000/grabbingProduct2?username='+str(userid)+'&page='+str(page)
                yield scrapy.Request(URL)
                nama_products = response.xpath('//*[@class="nama_product"]/text()').extract()
                descriptions = response.xpath('//*[@class="description"]/text()').extract()
                images = response.xpath('//*[@class="image"]/text()').extract()
                prices = response.xpath('//*[@class="price"]/text()').extract()
                    
                for nama_product, description, image, price in zip(nama_products, descriptions, images, prices):
                    yield{'nama_product': nama_product,
                            'description' : description,
                            'image' : image,
                            'price': price}
                    #try: 
                    #    os.mkdir('images') 
                    #except: 
                    #    pass
                    # Images
                    #response = requests.get("https://cf.shopee.co.id/file/"+image)
                    #file = open("images/"+image+'.jpg', "wb")
                    #file.write(response.content)
                    #file.close()
                    # Write Txt
                    # writers = open('cappsGrab.txt', 'a+', encoding="utf-8")
                    # writers.writelines(f"{nama_product}|{description}|{image}|{price}\n")
                    # writers.close()
            
    #def parse_grab_product(self, response):
