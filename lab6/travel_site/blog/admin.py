from django.contrib import admin
from .models import Page, Post, City, Attraction, Tour

admin.site.register(Page)
admin.site.register(Post)


@admin.register(City)
class CityAdmin(admin.ModelAdmin):
    prepopulated_fields = {"slug": ("name",)}
    list_display = ("name",)


@admin.register(Attraction)
class AttractionAdmin(admin.ModelAdmin):
    list_display = ("name", "city", "address")
    list_filter = ("city",)

admin.site.register(Tour)
