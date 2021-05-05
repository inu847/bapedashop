import scrapy
from scrapy.http import FormRequest
from scrapy.utils.response import open_in_browser
from scrapy.http import Request

class ProductSpider(scrapy.Spider):
    name = 'product'
    # allowed_domains = ['http://localhost/bapedashop/public']
    start_urls = ['http://localhost/bapedashop/public/login']

    def parse(self, response):
        token = response.xpath('//*[@name="_token"]/@value').extract_first()
        
        yield FormRequest('http://localhost/bapedashop/public/login',
                          formdata={'_token': token,
                                    'email': 'adin72978@gmail.com',
                                    'password': 'Semogaberkah'},
                            callback=self.parse_after_login)

    def parse_after_login(self, response):
        # open_in_browser(response)
        upload_product = 'http://localhost/bapedashop/public/manage-product/create'
        yield Request(upload_product, callback=self.parse_upload)
    def parse_upload(self, response):
        token_product = response.xpath('//*[@name="_token"]/@value').extract_first()
        print("token product"+token_product)
        urls = open(r"./grabShopee.txt", "r", encoding="utf-8")
        keywoards = urls.readlines()
        for key in keywoards:
            itemId = key.split("|")[0]
            shopid = key.split("|")[1]
            name = key.split("|")[2]
            price = key.split("|")[3]
            images = key.split("|")[4]
            img = images.split()[1]
            # for image in img:
            # options = key.split("|")[5]
            yield FormRequest('http://localhost/bapedashop/public/manage-product/create',
                                formdata={'_token': token_product,
                                            'nama_product' : str(name),
                                            'deskripsi' : str(itemId+shopid),
                                            'stok' : str(5),
                                            'images' : 'g32o4g123g4123t4123g4i91234',
                                            'price' : str(price)},
                                    callback=self.parse_after_upload)
    def parse_after_upload(self, response):
        open_in_browser(response)
        
            
            
            
            
