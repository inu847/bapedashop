import scrapy
from scrapy.http import Request
import os
import requests
from scrapy.loader import ItemLoader
from capps.items import CappsItem
import xlsxwriter

class GetprodSpider(scrapy.Spider):
    name = 'getprod'
    #allowed_domains = ['capps.com']
    start_urls = ['http://127.0.0.1:8000/']

    def parse(self, response):
        urls = open(r"LinkSupplierBlitar.txt", "r")
        keywoards = urls.readlines()

        for key in keywoards:
            userid = key.replace('https://shopee.co.id/', '').strip()

            workbook = xlsxwriter.Workbook('sheet/'+userid+'.xlsx')
            worksheet = workbook.add_worksheet()
            # HEADER
            worksheet.write(0, 0, 'nama product')
            worksheet.write(0, 1, 'deskripsi')
            worksheet.write(0, 2, 'price')
            worksheet.write(0, 3, 'image')
            for page in range(0,91,30):
                URL = 'http://127.0.0.1:8000/grabbingProduct2?username='+str(userid)+'&page='+str(page)
                yield scrapy.Request(URL)
                nama_products = response.xpath('//*[@class="nama_product"]/text()').extract()
                descriptions = response.xpath('//*[@class="description"]/text()').extract()
                images = response.xpath('//*[@class="image"]/text()').extract()
                prices = response.xpath('//*[@class="price"]/text()').extract()

                for nama_product, description, image, price, x in zip(nama_products, descriptions, images, prices, range(page, page+31)):
                    img = image.strip()
                    for y in range(0, 4):
                        if y == 0:
                            worksheet.write(x, y, nama_product)
                        elif y == 1:
                            worksheet.write(x, y, description)
                        elif y == 2:
                            worksheet.write(x, y, str(price))
                        elif y == 3:
                            worksheet.write(x, y, img)
            workbook.close()
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
