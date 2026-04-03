from fastapi import FastAPI
from pydantic import BaseModel
from sqlalchemy import create_engine, text

app = FastAPI()

# MySQL connection (same as Laravel)
engine = create_engine("mysql+pymysql://root:your_password@localhost/inventory_db")
class UpdateStock(BaseModel):
    sku: str
    change: int

@app.get("/")
def root():
    return {"message": "API working"}

@app.post("/inventory/update")
def update_stock(data: UpdateStock):
    with engine.connect() as conn:
        conn.execute(
            text("UPDATE products SET quantity = quantity + :change WHERE sku = :sku"),
            {"change": data.change, "sku": data.sku}
        )
        conn.commit()
    return {"message": "Stock updated successfully"}