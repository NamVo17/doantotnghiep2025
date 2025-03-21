import pandas as pd
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.metrics.pairwise import cosine_similarity
import sys
import json
import numpy as np
# Nhận ID sản phẩm từ tham số dòng lệnh
product_id = int(sys.argv[1])

# Đọc dữ liệu sản phẩm từ file CSV (có thể xuất từ MySQL)
df = pd.read_csv('products.csv')

# Chuyển đổi cột giá thành dạng số
df['price'] = pd.to_numeric(df['price'])

# Vector hóa mô tả sản phẩm
vectorizer = TfidfVectorizer(stop_words='english')
tfidf_matrix = vectorizer.fit_transform(df['introduce'])

# Tính độ tương đồng Cosine giữa các sản phẩm
cosine_sim = cosine_similarity(tfidf_matrix, tfidf_matrix)

# Lấy chỉ số của sản phẩm hiện tại
idx = df[df['id'] == product_id].index[0]

# Sắp xếp sản phẩm theo độ tương đồng
similar_products = list(enumerate(cosine_sim[idx]))
similar_products = sorted(similar_products, key=lambda x: x[1], reverse=True)

# Chọn ra 5 sản phẩm tương tự nhất (trừ chính nó)
recommendations = [df.iloc[i[0]]['id'] for i in similar_products[1:6]]

print(json.dumps(recommendations, default=lambda x: int(x) if isinstance(x, np.integer) else x))