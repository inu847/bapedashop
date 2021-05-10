import xlsxwriter

workbook = xlsxwriter.Workbook('data.xlsx')
worksheet = workbook.add_worksheet()

# HEADER
worksheet.write(0, 0, 'nama product')
worksheet.write(0, 1, 'deskripsi')
worksheet.write(0, 2, 'image')
worksheet.write(0, 3, 'price')

# BODY
for x in range(1, 1000):
	for y in range(0, 4):
		print(x)
		worksheet.write(x, y, "isian ke"+str(x))

workbook.close()
