import sqlite3

DB_NAME = "hh_data.db"


def setup_database():
    conn = sqlite3.connect(DB_NAME)
    cursor = conn.cursor()
    cursor.execute("DROP TABLE IF EXISTS vacancies")
    cursor.execute(
        """
        CREATE TABLE IF NOT EXISTS vacancies (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            title TEXT,
            salary TEXT,
            company TEXT
        )
    """
    )
    cursor.execute("DELETE FROM vacancies")
    conn.commit()
    return conn
