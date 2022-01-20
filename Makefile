add-assets:
	npm run production
	git add public/
	git commit -m "Add compiled assets"

.PHONY: all
