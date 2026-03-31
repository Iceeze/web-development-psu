import re

import requests
from bs4 import BeautifulSoup

BASE_URL = "https://hh.ru/search/vacancy"
CNT_PAGES = 1


def parse_and_save_data(conn):
    url = BASE_URL
    headers = {
        "User-Agent": "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36",
        "Accept": "text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8",
    }
    params = {"text": "python", "search_field": "name", "area": 113}

    cursor = conn.cursor()
    saved_count = 0

    for page_num in range(CNT_PAGES):
        params["page"] = page_num
        try:
            response = requests.get(url, headers=headers, params=params)

            if response.status_code != 200:
                print(f"Ошибка доступа. Код: {response.status_code}")
                return

            soup = BeautifulSoup(response.text, "html.parser")
            vacancies = soup.find_all("div", attrs={"data-qa": "vacancy-serp__vacancy"})

            for vacancy in vacancies:
                title_element = vacancy.find(attrs={"data-qa": "serp-item__title"})
                title = title_element.text if title_element else "Не указано"

                experience_element = vacancy.find(
                    attrs={
                        "data-qa": re.compile(r"^vacancy-serp__vacancy-work-experience")
                    }
                )
                experience = (
                    experience_element.text.strip()
                    if experience_element
                    else "Опыт не указан"
                )

                company_element = vacancy.find(
                    attrs={"data-qa": "vacancy-serp__vacancy-employer-text"}
                )
                company = (
                    company_element.text.replace(" ", " ")
                    if company_element
                    else "Не указано"
                )

                cursor.execute(
                    "INSERT INTO vacancies (title, company, experience) VALUES (?, ?, ?)",
                    (title, company, experience),
                )
                saved_count += 1
        except Exception:
            break

    conn.commit()
    print(f"Успешно сохранено вакансий: {saved_count}")
