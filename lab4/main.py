from db import setup_database
from parsing import parse_and_save_data
from report import generate_html_report


def main():
    db_connection = setup_database()

    try:
        parse_and_save_data(db_connection)
        generate_html_report(db_connection)
    finally:
        db_connection.close()


if __name__ == "__main__":
    main()
