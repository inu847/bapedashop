import scrapy
from scrapy.http import Request
import os
import requests
from scrapy.loader import ItemLoader
from capps.items import CappsItem
import csv

class GetprodSpider(scrapy.Spider):
    name = 'getprod'
    #allowed_domains = ['capps.com']
    start_urls = ['http://127.0.0.1:8000/grabbingProduct2/']

    def parse(self, response):
        urls = open(r"LinkSupplierBlitar.txt", "r")
        keywoards = urls.readlines()
        data_list = [["nama_product"], ["description"], ["img"], ["price"]]
        with open('output.csv', 'w') as file:
                    writer = csv.writer(file)
                    writer.write(data_list)
        # for key in keywoards:
        #     userid = key.replace('https://shopee.co.id/', '').strip()
            # for page in range(0,90,30):
                
            #     URL = 'http://127.0.0.1:8000/grabbingProduct2?username='+str(userid)+'&page='+str(page)
            #     yield scrapy.Request(URL)
            #     nama_products = response.xpath('//*[@class="nama_product"]/text()').extract()
            #     descriptions = response.xpath('//*[@class="description"]/text()').extract()
            #     images = response.xpath('//*[@class="image"]/text()').extract()
            #     prices = response.xpath('//*[@class="price"]/text()').extract()
                
                
            #     for nama_product, description, image, price in zip(nama_products, descriptions, images, prices):
            #         img = image.strip()
            #         image_url = "https://cf.shopee.co.id/file/"+img
            #         loader = ItemLoader(item=CappsItem(), selector=image_url)
            #         loader.add_value('image_urls', image_url)
            #         data_list = [nama_product, description.strip(), img, price.strip()]
            #         with open('output.csv', 'w', newline='') as file:
            #                     writer = csv.writer(file, delimiter='|')
            #                     writer.writerows(data_list)
                    # loader.add_value('nama_product', nama_product)
                    # loader.add_value('description', description.strip())
                    # loader.add_value('img', img)
                    # loader.add_value('price', price.strip())
                    # yield{'nama_product': nama_product,
                    #     'description': description.strip(),
                    #     'img': img,
                    #     'price': price.strip()

                    # }
                    # yield loader.load_item()
            
    #def parse_grab_product(self, response):
