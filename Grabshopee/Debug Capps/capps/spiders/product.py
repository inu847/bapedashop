import scrapy
from scrapy.http import FormRequest
from scrapy.utils.response import open_in_browser
from scrapy.http import Request

class ProductSpider(scrapy.Spider):
    name = 'product'
    # allowed_domains = ['http://localhost/bapedashop/public']
    start_urls = {'http://localhost/bapedashop/public/manage-product/botMigrasiUpload'}

    def parse(self, response):
        token = response.xpath('//*[@name="_token"]/@value').extract_first()

        yield FormRequest('http://localhost/bapedashop/public/login',
                            formdata={'_token': token,
                                        'email': 'adin72978@gmail.com',
                                        'password': 'Semogaberkah'},
                                        meta={'cookiejar': '1'},
                                callback=self.parse_after_login,)

    def parse_after_login(self, response):
        open_in_browser(response)
        urls = open(r"grabShopee.txt", "r", encoding="utf-8")
        keywoards = urls.readlines()
        for key in keywoards:
            itemId = key.split("|")[0]
            shopid = key.split("|")[1]
            name = key.split("|")[2]
            price = key.split("|")[3]
            images = key.split("|")[4]
            # test_files = open("images/"+images+".jpg", "rb")
            
            # for image in img:
            # options = key.split("|")[5]
            yield FormRequest('http://localhost/bapedashop/public/manage-product/botMigrasiUpload',
                                formdata={  'nama_product' : name,
                                            'deskripsi' : str(itemId+shopid),
                                            'stok' : '6',
                                            'images' : images,
                                            'price' : price,
                                            'status' : 'publish'},
                                            meta={'cookiejar': response.meta['cookiejar']})
    # def parse_after_upload(self, response):
    #     open_in_browser(response)
        
            
            
            
            
