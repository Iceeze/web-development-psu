from django.db import models
import markdown


class Page(models.Model):
    title = models.CharField(max_length=100, verbose_name="Заголовок страницы")
    slug = models.SlugField(unique=True, verbose_name="URL страницы")
    content = models.TextField(verbose_name="Текст страницы")

    @property
    def content_html(self):
        return markdown.markdown(self.content, extensions=["extra"])

    def __str__(self) -> str:
        return self.title


class Post(models.Model):
    title = models.CharField(max_length=100, verbose_name="Название статьи")
    content = models.TextField(verbose_name="Текст статьи")
    created_at = models.DateTimeField(auto_now_add=True, verbose_name="Дата публикации")

    def __str__(self) -> str:
        return self.title


class City(models.Model):
    name = models.CharField(max_length=100, verbose_name="Название города")
    slug = models.SlugField(unique=True, verbose_name="URL города")

    def __str__(self):
        return self.name


class Attraction(models.Model):
    city = models.ForeignKey(
        City, on_delete=models.CASCADE, related_name="attractions", verbose_name="Город"
    )
    name = models.CharField(
        max_length=200, verbose_name="Название достопримечательности"
    )
    address = models.CharField(max_length=300, verbose_name="Адрес", blank=True)

    def __str__(self):
        return self.name
