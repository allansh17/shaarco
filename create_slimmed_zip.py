import os
import zipfile

EXCLUDE_DIRS = {
    "node_modules", ".venv", "__pycache__", ".git", ".idea", ".vscode",
    "media", "uploads", "static", "logs"
}
EXCLUDE_FILES_EXT = {
    ".log", ".sqlite3", ".mp4", ".mkv", ".zip", ".csv", ".json", ".tsv"
}
EXCLUDE_FILES = {".env", ".DS_Store"}

def should_exclude(path):
    if any(ex in path for ex in EXCLUDE_DIRS):
        return True
    if os.path.basename(path) in EXCLUDE_FILES:
        return True
    if os.path.splitext(path)[1] in EXCLUDE_FILES_EXT:
        return True
    return False

def zip_folder(folder_path, output_path):
    with zipfile.ZipFile(output_path, 'w', zipfile.ZIP_DEFLATED) as zipf:
        for root, dirs, files in os.walk(folder_path):
            # Skip excluded directories
            dirs[:] = [d for d in dirs if not should_exclude(os.path.join(root, d))]
            for file in files:
                full_path = os.path.join(root, file)
                if should_exclude(full_path):
                    continue
                rel_path = os.path.relpath(full_path, folder_path)
                zipf.write(full_path, rel_path)

zip_folder(".", "project_slimmed.zip")
print("✅ Slimmed zip created: project_slimmed.zip")