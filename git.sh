
DATE=$(date +"%Y-%m-%d_%H-%M-%S")

git add .

git commit -m "Backup on $DATE"

git push origin main

echo "✅ Successfully backed up to GitHub on $DATE"
