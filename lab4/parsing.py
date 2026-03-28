import requests
from bs4 import BeautifulSoup

URL = "https://hh.ru/search/vacancy?text=python&search_field=name&area=113"


def parse_and_save_data(conn):
    url = URL

    headers = {
        "User-Agent": "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36",
        "Accept": "text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8",
    }

    print(f"Отправляем запрос к: {url}")
    response = requests.get(url, headers=headers)

    if response.status_code != 200:
        print(f"Ошибка доступа. Код: {response.status_code}")
        return

    soup = BeautifulSoup(response.text, "html.parser")

    vacancies = soup.find_all("div", attrs={"data-qa": "vacancy-serp__vacancy"})

    cursor = conn.cursor()
    saved_count = 0

    for page_num in range(1):
        url += f"?page={page_num}"
        try:
            for vacancy in vacancies:
                title_element = vacancy.find(attrs={"data-qa": "serp-item__title"})
                title = title_element.text if title_element else "Не указано"

                salary_element = vacancy.find(
                    attrs={"data-qa": "vacancy-serp__vacancy-compensation"}
                )
                salary = (
                    salary_element.text.replace(" ", " ")
                    if salary_element
                    else "З/п не указана"
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
                    "INSERT INTO vacancies (title, salary, company) VALUES (?, ?, ?)",
                    (title, salary, company),
                )
                saved_count += 1
        except Exception:
            break

    conn.commit()
    print(f"Успешно сохранено вакансий: {saved_count}")
