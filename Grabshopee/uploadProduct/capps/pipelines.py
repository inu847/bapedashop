# Define your item pipelines here
#
# Don't forget to add your pipeline to the ITEM_PIPELINES setting
# See: https://docs.scrapy.org/en/latest/topics/item-pipeline.html


# useful for handling different item types with a single interface
from itemadapter import ItemAdapter


class CappsPipeline:
    def process_item(self, item, spider):
        return item

    # SAVE IMAGE
    # os.chdir('C:/xampp/htdocs/scraping/books_crawler')

    #     if item['images'][0]['path']:
    #         new_image_name = item['title'][0] + '.jpg'
    #         new_image_path = 'full/' + new_image_name

    #         os.rename(item['images'][0]['path'], new_image_path)